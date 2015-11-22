<?php

namespace Bundle\WebBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends FOSRestController
{
    /**
     * @return Response
     */
    public function indexAction()
    {
        $data = [
            'name' => 'Kanunak Currency Exchange API',
            'documentation' => $this->generateUrl('nelmio_api_doc_index'),
        ];

        $view = $this->view($data, Response::HTTP_OK)->setFormat('json');

        return $this->handleView($view);
    }
}
