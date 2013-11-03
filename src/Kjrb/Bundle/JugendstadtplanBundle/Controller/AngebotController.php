<?php

namespace Kjrb\Bundle\JugendstadtplanBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Kjrb\Bundle\JugendstadtplanBundle\Entity\Angebot;

/**
 * Class AngebotController
 * @package Kjrb\Bundle\JugendstadtplanBundle\Controller
 *
 * @Route("/angebot")
 */
class AngebotController extends Controller {

    /**
     * @Route()
     * @Template()
     *
     * @return array
     */
    public function indexAction() {
        return array(
            'angebote' => $this->get('kjrb.jugendstadtplan.angebot_repository')->findAll()
        );
    }

    /**
     * @Route("/{id}/detail")
     * @ParamConverter("angebot", class="KjrbJugendstadtplanBundle:Angebot")
     * @Template()
     *
     * @param Angebot $angebot
     * @return array
     */
    public function detailAction(Angebot $angebot) {
        return array('angebot' => $angebot);
    }

}
 