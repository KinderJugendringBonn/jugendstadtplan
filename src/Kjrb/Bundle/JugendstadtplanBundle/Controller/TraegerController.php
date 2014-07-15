<?php

namespace Kjrb\Bundle\JugendstadtplanBundle\Controller;

use Kjrb\Bundle\JugendstadtplanBundle\Entity\Adresse;
use Kjrb\Bundle\JugendstadtplanBundle\Entity\Ansprechpartner;
use Kjrb\Bundle\JugendstadtplanBundle\Entity\Kategorie;
use Kjrb\Bundle\JugendstadtplanBundle\Entity\Link;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Kjrb\Bundle\JugendstadtplanBundle\Entity\Traeger;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class TraegerController
 * @package Kjrb\Bundle\JugendstadtplanBundle\Controller
 *
 * @Route("/traeger")
 */
class TraegerController extends BaseController {

    /**
     * @Route()
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction() {
        return $this->sendJsonResponse($this->getTraegerRepository()->findAll());
    }

    /**
     * @Route("/create", name="api_traeger_create")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function createAction() {
        $traeger = $this->setDataFromJson();

        // TODO: Checks!

        if (!$this->getTraegerRepository()->findByEmail($traeger->getEmail())) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($traeger);
            $em->flush();
        } else {
            return $this->sendJsonResponse('Träger existiert bereits!', 409); // Send "Conflict"
        }

        return $this->sendJsonResponse($traeger);
    }

    /**
     * @Route("/update/{id}", name="api_traeger_update")
     *
     * @ParamConverter("traeger", class="KjrbJugendstadtplanBundle:Traeger")
     * @return Response
     */
    public function updateAction(Traeger $traeger) {
        $this->setDataFromJson($traeger);

        $em = $this->getDoctrine()->getManager();
        $em->persist($traeger);
        $em->flush();

        return $this->sendJsonResponse($traeger);
    }

    private function setDataFromJson(Traeger $traeger = null) {
        $rawData = file_get_contents("php://input");
        $data = json_decode($rawData);

        if ($traeger === null) {
            $traeger = new Traeger($data->email, $data->passwort);
        } else {
            if (isset($data->email)) {
                $traeger->setEmail($data->email);
            }
            if (isset($data->passwort)) {
                $traeger->setPassword($data->passwort);
            }
        }

        // Ansprechpartner
        if (isset($data->ansprechpartner)) {
            // TODO: Unperformant und auch nicht besonders Elegant immer alle Ansprechpartner zu löschen...
            $traeger->deleteAllAnsprechpartner(array());
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
                $traeger->addAnsprechpartner($ansprechpartner);
            }
        }

        // Kategorie
        if (isset($data->kategorie)) {
            $kategorie = $this->getKategorieRepository()->find($data->kategorie);
            $traeger->setKategorie($kategorie);
        }

        // Links
        if (isset($data->links)) {
            // TODO: Unelegant
            $traeger->deleteAllLinks();
            foreach ($data->links as $rawLink) {
                $link = new Link($rawLink->titel, $rawLink->url);
                $traeger->addLink($link);
            }
        }

        // Adressen
        if (isset($data->adressen)) {
            // TODO: Unelegant
            $traeger->deleteAllAdressen();
            foreach ($data->adressen as $rawAdresse) {
                $adresse = new Adresse($rawAdresse->strasse, $rawAdresse->ort);
                $adresse->setPlz($rawAdresse->plz);
                $traeger->addAdresse($adresse);
            }
        }

        $traeger->setTitel($data->titel);
        if (isset($data->beschreibung)) {
            $traeger->setBeschreibung($data->beschreibung);
        }

        return $traeger;
    }

    /**
     * @Route("/delete/{id}", name="api_traeger_delete")
     *
     * @ParamConverter("traeger", class="KjrbJugendstadtplanBundle:Traeger")
     * @return Response
     */
    public function deleteAction(Traeger $traeger) {
        $em = $this->getDoctrine()->getManager();
        $em->remove($traeger);
        $em->flush();

        return new Response();
    }

    /**
     * @Route("/{id}", name="api_traeger_detail")
     * @ParamConverter("traeger", class="KjrbJugendstadtplanBundle:Traeger")
     *
     * @param Traeger $traeger
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function detailAction(Traeger $traeger) {
        return $this->sendJsonResponse($traeger);
    }

}