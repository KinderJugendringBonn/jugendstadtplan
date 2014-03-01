<?php

namespace Kjrb\Bundle\JugendstadtplanBundle\Controller;

use Kjrb\Bundle\JugendstadtplanBundle\Form\TraegerType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Kjrb\Bundle\JugendstadtplanBundle\Entity\Traeger;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class TraegerController
 * @package Kjrb\Bundle\JugendstadtplanBundle\Controller
 *
 * @Route("/traeger")
 */
class TraegerController extends BaseController {

    /**
     * @Route("/")
     * @Template()
     *
     * @return array
     */
    public function indexAction() {
        return $this->sendJsonResponse($this->getTraegerRepository()->findAll());
    }

    /**
     * @Route("/{id}")
     * @ParamConverter("traeger", class="KjrbJugendstadtplanBundle:Traeger")
     * @Template()
     *
     * @param Traeger $traeger
     * @return array
     */
    public function detailAction(Traeger $traeger) {
        return $this->sendJsonResponse($traeger);
    }

    /**
     * @Route("/erstellen")
     * @Template()
     *
     * @param Request $request
     * @return array
     */
    public function erstellenAction(Request $request) {
        $traeger = new Traeger();

        $form = $this->createForm(new TraegerType(), $traeger);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($traeger);
            $em->flush();

            $this->get('session')->getFlashBag()->add('success', $this->get('translator')->trans('traeger_erfolgreich_angelegt'));
            return $this->redirect($this->generateUrl('kjrb_jugendstadtplan_startseite_startseite'));
        }

        return array('form' => $form->createView());
    }

}
 