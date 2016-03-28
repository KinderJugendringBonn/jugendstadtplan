<?php

namespace Kjrb\Bundle\JugendstadtplanBundle\Controller;

use Kjrb\Bundle\JugendstadtplanBundle\Entity\Adresse;
use Kjrb\Bundle\JugendstadtplanBundle\Entity\Ansprechpartner;
use Kjrb\Bundle\JugendstadtplanBundle\Entity\Bild;
use Kjrb\Bundle\JugendstadtplanBundle\Entity\Kategorie;
use Kjrb\Bundle\JugendstadtplanBundle\Entity\Link;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Kjrb\Bundle\JugendstadtplanBundle\Entity\Traeger;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
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
     * @Security("is_granted('IS_AUTHENTICATED_ANONYMOUSLY')")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction() {
        return $this->sendJsonResponse($this->getTraegerRepository()->findAllActivated());
    }

    /**
     * @Route("/create", name="api_traeger_create")
     * @Security("is_granted('IS_AUTHENTICATED_ANONYMOUSLY')")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function createAction() {
        $traeger = $this->setDataFromJson();

        // TODO: Checks!

        if ($traeger !== null && !$this->getTraegerRepository()->findByEmail($traeger->getEmail())) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($traeger);
            $em->flush();

            if ($traeger->getBilder()) {
                $imgFolder = $_SERVER['DOCUMENT_ROOT'] . '/img/';
                if (!file_exists($imgFolder . $traeger->getId())) {
                    mkdir($imgFolder . $traeger->getId());
                }
                foreach ($traeger->getBilder() as $bild) {
                    rename($imgFolder . $bild->getTmpName() . '/' . $bild->getFileName(), $imgFolder . $traeger->getId() . '/' . $bild->getFileName());
                    rmdir($imgFolder . $bild->getTmpName());
                }
            }
        } else {
            return $this->sendJsonResponse('Träger existiert bereits!', 409); // Send "Conflict"
        }

        return $this->sendJsonResponse($traeger);
    }

    /**
     * @Route("/update/{id}", name="api_traeger_update")
     * @Security("is_granted('FEATURE_TRAEGER_CRUD')")
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

        if ($traeger === null && isset($data->email)) {
            $traeger = new Traeger($data->email);

            if (isset($data->password)) {
                $encoder = $this->container->get('security.password_encoder');
                $encoded = $encoder->encodePassword($traeger, $data->passwort);

                $traeger->setPassword($encoded);
            }
        } else {
            if (isset($data->email)) {
                $traeger->setEmail($data->email);
            }
            if (isset($data->passwort)) {
                $encoder = $this->container->get('security.password_encoder');
                $encoded = $encoder->encodePassword($traeger, $data->passwort);

                $traeger->setPassword($encoded);
            }
        }

        // Ansprechpartner
        if (isset($data->ansprechpartner)) {
            // TODO: Unperformant und auch nicht besonders Elegant immer alle Ansprechpartner zu löschen...
            $traeger->deleteAllAnsprechpartner();
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
            /** @var Kategorie $kategorie */
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

        if (isset($data->titel)) {
            $traeger->setTitel($data->titel);
        }
        if (isset($data->beschreibung)) {
            $traeger->setBeschreibung($data->beschreibung);
        }

        if (isset($data->bilder)) {
            // TODO: Unelegant
            $traeger->deleteAllBilder();
            foreach ($data->bilder as $rawBild) {
                $bild = new Bild();
                $bild->setFileName($rawBild->name);
                $bild->setFileType($rawBild->type);
                $bild->setFileChangetime(new \DateTime($rawBild->lastModifiedDate));
                $bild->setFileSize($rawBild->size);
                $bild->setTmpName($rawBild->tmp_name);
                $traeger->addBild($bild);
            }
        }

        return $traeger;
    }

    /**
     * @Route("/delete/{id}", name="api_traeger_delete")
     * @Security("is_granted('FEATURE_TRAEGER_CRUD')")
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
     * @Security("is_granted('IS_AUTHENTICATED_ANONYMOUSLY')")
     *
     * @param Traeger $traeger
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function detailAction(Traeger $traeger) {
        return $this->sendJsonResponse($traeger);
    }

}