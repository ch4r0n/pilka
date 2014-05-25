<?php

namespace Skoki\OrlikBundle\Controller;

use Skoki\OrlikBundle\Repository\Repository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MatchController extends Controller
{
    public function showAction($id)
    {
        $match = $this->getDoctrine()
            ->getRepository(Repository::MATCHES)
            ->findOneById($id);

        $matchManager = $this->get('orlik.match.manager');
        $teamsForm = array(
            'home' => $matchManager->getTeamLastMatches($match->getHome()),
            'away' => $matchManager->getTeamLastMatches($match->getAway())
        );

        $match = $matchManager->getMatchDetails($match);

        return $this->render('SkokiOrlikBundle:Match:show.html.twig', array('match' => $match, 'teams_form' => $teamsForm));
    }

    public function updateAction($id)
    {
    }

}
