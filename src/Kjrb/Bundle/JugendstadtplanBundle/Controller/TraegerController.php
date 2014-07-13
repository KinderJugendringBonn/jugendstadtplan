<?php

namespace Kjrb\Bundle\JugendstadtplanBundle\Controller;

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