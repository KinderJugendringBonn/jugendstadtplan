<?php

namespace Kjrb\Bundle\JugendstadtplanBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Kjrb\Bundle\JugendstadtplanBundle\Entity\Ort;

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

}
 