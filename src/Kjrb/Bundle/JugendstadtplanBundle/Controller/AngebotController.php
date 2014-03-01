<?php

namespace Kjrb\Bundle\JugendstadtplanBundle\Controller;

use Kjrb\Bundle\JugendstadtplanBundle\Form\AngebotType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Kjrb\Bundle\JugendstadtplanBundle\Entity\Angebot;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class AngebotController
 * @package Kjrb\Bundle\JugendstadtplanBundle\Controller
 *
 * @Route("/angebote")
 */
class AngebotController extends BaseController {

    /**
     * @Route()
     * @Template()
     *
     * @return array
     */
    public function indexAction() {
        return $this->sendJsonResponse($this->getAngebotRepository()->findAll());
    }

    /**
     * @Route("/{id}")
     * @ParamConverter("angebot", class="KjrbJugendstadtplanBundle:Angebot")
     * @Template()
     *
     * @param Angebot $angebot
     * @return array
     */
    public function detailAction(Angebot $angebot) {
        return $this->sendJsonResponse($angebot);
    }


    /**
     * @Route("/erstellen")
     * @Template()
     *
     * @param Request $request
     * @return array
     */
    public function erstellenAction(Request $request) {
        $angebot = new Angebot();

        $form = $this->createForm(new AngebotType($this->get('translator')), $angebot);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($angebot);
            $em->flush();

            $this->get('session')->getFlashBag()->add('success', $this->get('translator')->trans('angebot_erfolgreich_angelegt'));
            return $this->redirect($this->generateUrl('kjrb_jugendstadtplan_startseite_startseite'));
        }

        return array('form' => $form->createView());
    }

}
 