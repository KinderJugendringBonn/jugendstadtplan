<?php

namespace Kjrb\Bundle\JugendstadtplanBundle\Controller;

use Kjrb\Bundle\JugendstadtplanBundle\Entity\Adresse;
use Kjrb\Bundle\JugendstadtplanBundle\Entity\Ansprechpartner;
use Kjrb\Bundle\JugendstadtplanBundle\Entity\Link;
use Kjrb\Bundle\JugendstadtplanBundle\Entity\Termin;
use Kjrb\Bundle\JugendstadtplanBundle\Entity\TerminWiederholung;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Kjrb\Bundle\JugendstadtplanBundle\Entity\Pin;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class PinController
 * @Route("/pins")
 * @package Kjrb\Bundle\JugendstadtplanBundle\Controller
 */
class PinController extends BaseController {

    /**
    * @Route()
    */
    public function indexAction() {
        return $this->sendJsonResponse($this->getPinRepository()->findAll());
    }

    /**
     * @Route("/create", name="api_pin_create")
     *
     * @param Request $request
     * @return Response
     */
    public function createAction(Request $request) {
        $pin = new Pin();
        $this->setDataFromJson($pin);

        // TODO: Checks!

        $em = $this->getDoctrine()->getManager();
        $em->persist($pin);
        $em->flush();

        return $this->sendJsonResponse($pin);
    }

    /**
     * @Route("/update/{id}", name="api_pin_update")
     *
     * @ParamConverter("pin", class="KjrbJugendstadtplanBundle:Pin")
     * @return Response
     */
    public function updateAction(Pin $pin) {
        $this->setDataFromJson($pin);

        $em = $this->getDoctrine()->getManager();
        $em->persist($pin);
        $em->flush();

        return $this->sendJsonResponse($pin);
    }

    private function setDataFromJson(Pin $pin) {
        $rawData = file_get_contents("php://input");
        $data = json_decode($rawData);

        $pin->setTitel($data->titel);

        // Kategorie
        if (isset($data->kategorie)) {
            $kategorie = $this->getKategorieRepository()->find($data->kategorie);
            $pin->setKategorie($kategorie);
        }

        if (isset($data->beschreibung)) {
            $pin->setBeschreibung($data->beschreibung);
        }

        // Adresse
        if (isset($data->adresse)) {
            $rawAdresse = $data->adresse;
            $adresse = new Adresse($rawAdresse->strasse, $rawAdresse->ort);
            $adresse->setPlz($rawAdresse->plz);
            $pin->setAdresse($adresse);
        }

        if (isset($data->markers) && isset($data->markers[0])) {
            $pin->setLatitude($data->markers[0]->lat);
            $pin->setLongitude($data->markers[0]->lng);
        }

        if (isset($data->barrierefreiheit)) {
            $pin->setBarrierefreiheit($data->barrierefreiheit);
        }

        if (isset($data->kostenart)) {
            $pin->setKostenArt($data->kostenart);
        }

        if (isset($data->kostenbemerkung)) {
            $pin->setKostenBemerkung($data->kostenbemerkung);
        }

        if (isset($data->anmeldepflichtig)) {
            $pin->setAnmeldepflichtig($data->anmeldepflichtig);
        }

        if (isset($data->anmdeldepflichtbemerkung)) {
            $pin->setAnmeldepflichtBemerkung($data->anmeldepflichtbemerkung);
        }

        if (isset($data->mindestalter)) {
            $pin->setMindestalter($data->mindestalter);
        }

        // Ansprechpartner
        if (isset($data->ansprechpartner)) {
            // TODO: Unperformant und auch nicht besonders Elegant immer alle Ansprechpartner zu löschen...
            $pin->deleteAllAnsprechpartner();
            foreach ($data->ansprechpartner as $rawAnsprechpartner) {
                $ansprechpartner = new Ansprechpartner($rawAnsprechpartner->name, $rawAnsprechpartner->email);
                if (isset($rawAnsprechpartner->telefonnummer)) {
                    $ansprechpartner->setTelefonnummer($rawAnsprechpartner->telefonnummer);
                }
                if (isset($rawAnsprechpartner->mobilnummer)) {
                    $ansprechpartner->setMobilnummer($rawAnsprechpartner->mobilnummer);
                }
                if (isset($rawAnsprechpartner->bemerkung)) {
                    $ansprechpartner->setBemerkung($rawAnsprechpartner->bemerkung);
                }
                $pin->addAnsprechpartner($ansprechpartner);
            }
        }

        if (isset($data->termine)) {
            // TODO: Unelegant
            $pin->deleteAllTermine();
            foreach ($data->termine as $rawTermin) {
                $isGanztaegig = isset($rawTermin->ganztaegig) && $rawTermin->ganztaegig == true ?: false;

                $beginnDatum = new \DateTime($rawTermin->beginn . ' ' . !$isGanztaegig ? $rawTermin->beginnUhrzeit :'');

                $termin = new Termin($beginnDatum);
                $termin->setGanztaegig($isGanztaegig);

                if (isset($data->ende)) {
                    $endzeit = '';
                    if (isset($data->endeUhrzeit)) {
                        $endzeit = ' ' . $data->endeUhrzeit;
                    }
                    $termin->setEnde(new \DateTime($data->ende . $endzeit));
                }

                foreach ($rawTermin->wiederholungen as $rawWiederholung) {
                    $wiederholung = new TerminWiederholung($rawWiederholung->wochentag);
                    if (isset($rawWiederholung->wocheDesMonats)) {
                        $wiederholung->setWocheDesMonats($rawWiederholung->wocheDesMonats);
                    }
                    if (isset($rawWiederholung->auchAnFeiertagen)) {
                        $wiederholung->setAuchAnFeiertagen($rawWiederholung->auchAnFeiertagen);
                    }
                    if (isset($rawWiederholung->auchInDenFerien)) {
                        $wiederholung->setAuchInDenFerien($rawWiederholung->auchInDenFerien);
                    }
                    $termin->addWiederholung($wiederholung);
                }
                $pin->addTermin($termin);
            }
        }

        // Links
        if (isset($data->links)) {
            // TODO: Unelegant
            $pin->deleteAllLinks();
            foreach ($data->links as $rawLink) {
                $link = new Link($rawLink->titel, $rawLink->url);
                $pin->addLink($link);
            }
        }

        if (isset($data->traeger) && $traeger = $this->getTraegerRepository()->find($data->traeger)) {
            $pin->setTraeger($traeger);
        }
    }

    /**
     * @Route("/delete/{id}", name="api_pin_delete")
     *
     * @ParamConverter("pin", class="KjrbJugendstadtplanBundle:Pin")
     * @return Response
     */
    public function deleteAction(Pin $pin) {
        $em = $this->getDoctrine()->getManager();
        $em->remove($pin);
        $em->flush();

        return new Response();
    }

    /**
     * @Route("/{id}")
     * @ParamConverter("pin", class="KjrbJugendstadtplanBundle:Pin")
     *
     * @param Pin $pin
     * @return Response
     */
    public function detailAction(Pin $pin) {
        return $this->sendJsonResponse($pin);
    }

}
