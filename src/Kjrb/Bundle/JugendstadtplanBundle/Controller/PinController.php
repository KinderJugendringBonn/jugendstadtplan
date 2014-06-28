<?php

namespace Kjrb\Bundle\JugendstadtplanBundle\Controller;

use Kjrb\Bundle\JugendstadtplanBundle\Form\PinType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
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
     * @Route("/create", name = "api_pin_create")
     *
     * @param Request $request
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
     * @Route("/update/{id}", name = "api_pin_update")
     * @ParamConverter("pin", class="KjrbJugendstadtplanBundle:Pin")
     */
    public function updateAction(Pin $pin) {
        $this->setDataFromJson($pin);

        $em = $this->getDoctrine()->getManager();
        $em->persist($pin);
        $em->flush();

        return $this->sendJsonResponse($pin);
    }

    private function setDataFromJson(Pin $pin) {
        $data = file_get_contents("php://input");
        $pinData = json_decode($data);

        $pin->setTitel($pinData->titel);
        $pin->setBeschreibung($pinData->beschreibung);
        $pin->setLatitude($pinData->markers[0]->lat);
        $pin->setLongitude($pinData->markers[0]->lng);
    }

    /**
     * @Route("/delete/{id}", name = "api_pin_delete")
     * @ParamConverter("pin", class="KjrbJugendstadtplanBundle:Pin")
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
     * @return array
     */
    public function detailAction(Pin $pin) {
        return $this->sendJsonResponse($pin);
    }

    /**
     * @Route("/erstellen")
     * @Template()
     *
     * @param Request $request
     * @return array
     */
    public function erstellenAction(Request $request) {
        $pin = new Pin();

        $form = $this->createForm(new PinType($this->get('translator')), $pin);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($pin);
            $em->flush();

            $this->get('session')->getFlashBag()->add('success', $this->get('translator')->trans('pin_erfolgreich_angelegt'));
            return $this->redirect($this->generateUrl('kjrb_jugendstadtplan_startseite_startseite'));
        }

        return array('form' => $form->createView());
    }

}
 