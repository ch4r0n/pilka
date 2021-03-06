<?php

namespace Skoki\OrlikBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Skoki\OrlikBundle\Repository\Repository;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

class TeamController extends Controller
{
    public function showAction($id = null)
    {
        $team = $this->getDoctrine()
            ->getRepository(Repository::TEAMS)
            ->findOneById($id);

        $matchesHome = $this->getDoctrine()
            ->getRepository(Repository::MATCHES)
            ->findBy(array('home' => $id));
        $matchesAway = $this->getDoctrine()
            ->getRepository(Repository::MATCHES)
            ->findBy(array('away' => $id));

        //$last = $this->getDoctrine()->getRepository(Repository::MATCHES)->getTeamPlayedMatches($id);
        $matchManager = $this->get('orlik.match.manager');
        $last = $matchManager->getTeamLastMatches($id);
//        var_dump($last);die();
//        var_dump($matchesHome);die();
        $teamMatches = array_merge($matchesHome, $matchesAway);
        $matches = array();


        foreach ($teamMatches as $match) {
            $matches[$match->getRoundOrder()] = $matchManager->getMatchDetails($match);
        }
        asort($matches);

        $rozegraneMecze = $this->getDoctrine()
            ->getRepository(Repository::MATCHES)
            ->getTeamLasMatchList($id);
        $nowDate = new \DateTime();
        $timestamp = intval($nowDate->getTimestamp());

        $em = $this->getDoctrine()->getManager();
        if ($team) {
            $players = $em->getRepository('SkokiOrlikBundle:Players')->getTeamPlayers($team);

        }
        if (empty($players)) {
            $players = null;
        }
        $matches = array_reverse($matches);
        return $this->render('SkokiOrlikBundle:Team:Show.html.twig', array(
            'id' => $id,
            'team' => $team,
            'matches' => $matches,
            'teamForm' => $last,
            'nowDate' => $timestamp,
            'players' => $players));
    }

    public function listAction()
    {
        $teamsList = $this->getDoctrine()
            ->getRepository(Repository::TEAMS)
            ->findAll();
//var_dump($teamsList[0]->getPicture());die();
        return $this->render('SkokiOrlikBundle:Team:TeamList.html.twig', array('teamsList' => $teamsList));
    }
}
