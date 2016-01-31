<?php

namespace Kjrb\Bundle\JugendstadtplanBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class KategorieController
 * @package Kjrb\Bundle\JugendstadtplanBundle\Controller
 *
 * @Route("/kategorie")
 */
class KategorieController extends BaseController {

    /**
     * @Route(name="api_kategorie_list")
     * @Security("is_granted('IS_AUTHENTICATED_ANONYMOUSLY')")
     *
     * @return Response
     */
    public function indexAction() {
        return $this->sendJsonResponse($this->getKategorieRepository()->findAll());
    }

}