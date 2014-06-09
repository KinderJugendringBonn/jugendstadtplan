<?php

namespace Kjrb\Bundle\JugendstadtplanBundle\Controller;

use Hateoas\HateoasBuilder;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Kjrb\Bundle\JugendstadtplanBundle\Entity\OrtRepository;
use Kjrb\Bundle\JugendstadtplanBundle\Entity\TraegerRepository;
use Kjrb\Bundle\JugendstadtplanBundle\Entity\AngebotRepository;

class BaseController extends Controller {

    protected function sendJsonResponse($object) {
        $hateoas = HateoasBuilder::create()->build();

        $json = $hateoas->serialize($object, 'json');
        $response = new Response();
        $response->setContent($json);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * @return OrtRepository
     */
    protected function getOrtRepository() {
        return $this->get('kjrb.jugendstadtplan.ort_repository');
    }

    /**
    * @return TraegerRepository
    */
    protected function getTraegerRepository() {
        return $this->get('kjrb.jugendstadtplan.traeger_repository');
    }

    /**
    * @return AngebotRepository
    */
    protected function getAngebotRepository() {
        return $this->get('kjrb.jugendstadtplan.angebot_repository');
    }

}
 