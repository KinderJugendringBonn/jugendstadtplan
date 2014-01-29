<?php

namespace Kjrb\Bundle\JugendstadtplanBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class BaseController extends Controller {

    protected function sendJsonResponse($jsonEncodedString) {
        $response = new Response();
        $response->setContent($jsonEncodedString);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

}
 