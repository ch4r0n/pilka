<?php

namespace Skoki\OrlikBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TimetableController extends Controller
{
    public function indexAction()
    {
        return $this->render('SkokiOrlikBundle:Timetable:index.html.twig');
    }

}
