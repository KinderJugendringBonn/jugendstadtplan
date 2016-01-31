<?php

namespace Kjrb\Bundle\JugendstadtplanBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class StartseiteController extends Controller {

    /**
     * @Route()
     * @Template()
     * @Security("is_granted('IS_AUTHENTICATED_ANONYMOUSLY')")
     *
     * @return array
     */
    public function startseiteAction() {
        return array();
    }

}
 