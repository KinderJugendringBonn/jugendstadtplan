<?php

namespace Kjrb\Bundle\JugendstadtplanBundle\Controller;

use Kjrb\Bundle\JugendstadtplanBundle\Form\OrtType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Kjrb\Bundle\JugendstadtplanBundle\Entity\Ort;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class OrtController
 * @Route("/orte")
 * @package Kjrb\Bundle\JugendstadtplanBundle\Controller
 */
class OrtController extends BaseController {

    /**
    * @Route()
    */
    public function indexAction() {
        return $this->sendJsonResponse($this->getOrtRepository()->findAll());
    }

    /**
     * @Route("/create", name = "api_ort_create")
     *
     * @param Request $request
     */
    public function createAction(Request $request) {
        $ort = new Ort();
        $this->setDataFromJson($ort);

        // TODO: Checks!

        $em = $this->getDoctrine()->getManager();
        $em->persist($ort);
        $em->flush();

        return $this->sendJsonResponse($ort);
    }

    /**
     * @Route("/update/{id}", name = "api_ort_update")
     * @ParamConverter("ort", class="KjrbJugendstadtplanBundle:Ort")
     */
    public function updateAction(Ort $ort) {
        $this->setDataFromJson($ort);

        $em = $this->getDoctrine()->getManager();
        $em->persist($ort);
        $em->flush();

        return $this->sendJsonResponse($ort);
    }

    private function setDataFromJson(Ort $ort) {
        $data = file_get_contents("php://input");
        $ortData = json_decode($data);

        $ort->setTitel($ortData->titel);
        $ort->setBeschreibung($ortData->beschreibung);
        $ort->setLatitude($ortData->markers[0]->lat);
        $ort->setLongitude($ortData->markers[0]->lng);
    }

    /**
     * @Route("/delete/{id}", name = "api_ort_delete")
     * @ParamConverter("ort", class="KjrbJugendstadtplanBundle:Ort")
     */
    public function deleteAction(Ort $ort) {
        $em = $this->getDoctrine()->getManager();
        $em->remove($ort);
        $em->flush();

        return new Response();
    }

    /**
     * @Route("/{id}")
     * @ParamConverter("ort", class="KjrbJugendstadtplanBundle:Ort")
     *
     * @param Ort $ort
     * @return array
     */
    public function detailAction(Ort $ort) {
        return $this->sendJsonResponse($ort);
    }

    /**
     * @Route("/erstellen")
     * @Template()
     *
     * @param Request $request
     * @return array
     */
    public function erstellenAction(Request $request) {
        $ort = new Ort();

        $form = $this->createForm(new OrtType($this->get('translator')), $ort);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($ort);
            $em->flush();

            $this->get('session')->getFlashBag()->add('success', $this->get('translator')->trans('ort_erfolgreich_angelegt'));
            return $this->redirect($this->generateUrl('kjrb_jugendstadtplan_startseite_startseite'));
        }

        return array('form' => $form->createView());
    }

}
 