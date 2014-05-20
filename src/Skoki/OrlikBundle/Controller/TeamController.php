<?php

namespace Skoki\OrlikBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TeamController extends Controller
{
    public function showAction($id = null)
    {
        return $this->render('SkokiOrlikBundle:Team:Show.html.twig', array('id' => $id));
    }

}
