<?php

namespace Skoki\OrlikBundle\Controller;

use Skoki\OrlikBundle\Repository\Repository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TimetableController extends Controller
{
    public function indexAction()
    {
        $matchManager = $this->get('orlik.match.manager');
        $team = $matchManager->getTeamRepo()->getListForForm();
//        $session = $this->getRequest()->getSession();
//        $session->set('foo', 'bar');
//        var_dump($session->get('foo'));die();
        return $this->render('SkokiOrlikBundle:Timetable:index.html.twig');
    }

    public function showTimetableAction()
    {
        $matchManager = $this->get('orlik.match.manager');
        $tManager = $this->get('orlik.tournament.manager');
        $tManager->setRounds(1);
        $matchList = $matchManager->getMatchRepo()->findBy(array('rounds' => $tManager->getRounds()));

        return $this->render('SkokiOrlikBundle:Timetable:showTimetable.html.twig', array('matches' => $matchList));
    }

    public function matchListAction($matches)
    {
        $matchList = array();

        $matchList = $this->get('orlik.timetable.manager')->getTimetable($matches);
        $nowDate = new \DateTime();
        $timestamp = intval($nowDate->getTimestamp());

        return $this->render('SkokiOrlikBundle:Timetable:tableList.html.twig', array('matches' => $matchList, 'nowDate' => $timestamp));
//        return $this->render('SkokiOrlikBundle:Timetable:list.html.twig', array('matches' => $matchList));
    }

    public function shortMatchListAction($matches)
    {
        $matchList = array();

        $matchList = $this->get('orlik.timetable.manager')->getTimetable($matches);

        $nowDate = new \DateTime();
        $timestamp = intval($nowDate->getTimestamp());
        return $this->render('SkokiOrlikBundle:Timetable:shortTableList.html.twig', array('matches' => $matchList, 'nowDate' => $timestamp));
//        return $this->render('SkokiOrlikBundle:Timetable:list.html.twig', array('matches' => $matchList));
    }

}
