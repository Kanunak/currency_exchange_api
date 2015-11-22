<?php

namespace Bundle\ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('BundleApiBundle:Default:index.html.twig', array('name' => $name));
    }
}
