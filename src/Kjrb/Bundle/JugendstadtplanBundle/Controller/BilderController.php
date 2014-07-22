<?php

namespace Kjrb\Bundle\JugendstadtplanBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class BilderController
 * @package Kjrb\Bundle\JugendstadtplanBundle\Controller
 *
 * @Route("/img")
 */
class BilderController extends BaseController {

    /**
     * @Route("/upload", name="api_bild_upload")
     * @Method("POST")
     *
     * @return Response
     */
    public function uploadAction() {
        $hash = uniqid('img-', true);
        $folder = $_SERVER['DOCUMENT_ROOT'] . '/img/' . $hash;
        mkdir($folder);
        foreach ($_FILES as $tmpFile) {
            $file = new UploadedFile($tmpFile['tmp_name'], $tmpFile['name'], $tmpFile['type'], $tmpFile['size'], $tmpFile['error']);
            $file->move($folder . '/', $file->getClientOriginalName());
        }

        return $this->sendJsonResponse(array('folder' => $hash));
    }

}