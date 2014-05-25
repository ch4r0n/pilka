<?php

namespace Skoki\OrlikBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TimetableController extends Controller
{
    public function indexAction()
    {
        return $this->render('SkokiOrlikBundle:Timetable:index.html.twig');
    }

    public function showTimetableAction()
    {
//        var_dump($this->get('orlik.timetable.manager')->getTimetable());die();
        $matchManager = $this->get('orlik.match.manager');
        $matchList = $matchManager->getMatchRepo()->findAll();

        return $this->render('SkokiOrlikBundle:Timetable:showTimetable.html.twig', array('matches' => $matchList));
    }

    public function matchListAction($matches)
    {
        $matchList = array();
        $matchManager = $this->get('orlik.match.manager');

//        foreach ($matches as $match) {
//            if (is_array($match)) {
//                $matchList[] = $match;
//            } else {
//                $matchList[] = $matchManager->getMatchDetails($match);
//            }
//        }

        $matchList = $this->get('orlik.timetable.manager')->getTimetable($matches);
//
//        var_dump('<pre>', $matchList, '</pre>');die();
        return $this->render('SkokiOrlikBundle:Timetable:tableList.html.twig', array('matches' => $matchList));
//        return $this->render('SkokiOrlikBundle:Timetable:list.html.twig', array('matches' => $matchList));
    }

}
