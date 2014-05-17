<?php

namespace Skoki\OrlikBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('SkokiOrlikBundle:Default:index.html.twig', array('name' => $name));
    }

    public function homepageAction()
    {
        return $this->render('SkokiOrlikBundle:Default:homepage.html.twig');
    }
}
