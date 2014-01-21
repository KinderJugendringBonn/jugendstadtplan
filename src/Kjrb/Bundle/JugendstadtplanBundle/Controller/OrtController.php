<?php

namespace Kjrb\Bundle\JugendstadtplanBundle\Controller;

use Kjrb\Bundle\JugendstadtplanBundle\Form\OrtType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Kjrb\Bundle\JugendstadtplanBundle\Entity\Ort;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class OrtController
 * @package Kjrb\Bundle\JugendstadtplanBundle\Controller
 *
 * @Route("/ort")
 */
class OrtController extends Controller {

    /**
     * @Route()
     * @Template()
     *
     * @return array
     */
    public function indexAction() {
        return array(
            'orte' => $this->get('kjrb.jugendstadtplan.ort_repository')->findAll()
        );
    }

    /**
     * @Route("/{id}/detail")
     * @ParamConverter("ort", class="KjrbJugendstadtplanBundle:Ort")
     * @Template()
     *
     * @param Ort $ort
     * @return array
     */
    public function detailAction(Ort $ort) {
        return array('ort' => $ort);
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

    /**
     * @Route("/json-liste")
     */
    public function jsonListeAction() {
        $orte = $this->get('kjrb.jugendstadtplan.ort_repository')->findAll();

        $result = new \stdClass();
        foreach ($orte as $ort) {
            $id = $ort->getId();
            $current = new \stdClass();
            $current->id = $ort->getId();
            $current->title = $ort->getTitel();
            $current->message = '<h2>' . $ort->getTitel() . '</h2>' . $ort->getBeschreibung();
            $current->lng = $ort->getLongitude();
            $current->lat = $ort->getLatitude();
            $result->$id = $current;
        }

        $response = new Response();
        $response->setContent(json_encode($result));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

}
 