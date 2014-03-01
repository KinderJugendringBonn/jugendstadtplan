<?php

namespace Kjrb\Bundle\JugendstadtplanBundle\Controller;

use Kjrb\Bundle\JugendstadtplanBundle\Form\OrtType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
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
 