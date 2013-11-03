<?php

namespace Kjrb\Bundle\JugendstadtplanBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Kjrb\Bundle\JugendstadtplanBundle\Entity\Traeger;

/**
 * Class TraegerController
 * @package Kjrb\Bundle\JugendstadtplanBundle\Controller
 *
 * @Route("/traeger")
 */
class TraegerController extends Controller {

    /**
     * @Route()
     * @Template()
     *
     * @return array
     */
    public function indexAction() {
        return array(
            'traeger' => $this->get('kjrb.jugendstadtplan.traeger_repository')->findAll()
        );
    }

    /**
     * @Route("/{id}/detail")
     * @ParamConverter("traeger", class="KjrbJugendstadtplanBundle:Traeger")
     * @Template()
     *
     * @param Traeger $traeger
     * @return array
     */
    public function detailAction(Traeger $traeger) {
        return array('traeger' => $traeger);
    }

}
 