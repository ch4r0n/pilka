<?php

namespace Skoki\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name = 'jan')
    {
        return $this->render('SkokiUserBundle:Default:index.html.twig', array('name' => $name));
    }
}
