<?php

namespace Kjrb\Bundle\JugendstadtplanBundle\Controller;

use Hateoas\HateoasBuilder;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Kjrb\Bundle\JugendstadtplanBundle\Entity\PinRepository;
use Kjrb\Bundle\JugendstadtplanBundle\Entity\TraegerRepository;

class BaseController extends Controller {

    protected function sendJsonResponse($object, $statusCode = 200) {
        $hateoas = HateoasBuilder::create()->build();

        $json = $hateoas->serialize($object, 'json');
        $response = new Response();
        $response->setContent($json);
        $response->setStatusCode($statusCode);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * @return PinRepository
     */
    protected function getPinRepository() {
        return $this->get('kjrb.jugendstadtplan.pin_repository');
    }

    /**
    * @return TraegerRepository
    */
    protected function getTraegerRepository() {
        return $this->get('kjrb.jugendstadtplan.traeger_repository');
    }

}
 