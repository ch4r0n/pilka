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

        $matchManager = $this->get('match_manager');
        $match = $matchManager->getMatchDetails($match);

        return $this->render('SkokiOrlikBundle:Match:show.html.twig', array('match' => $match));
    }

    public function updateAction($id)
    {
    }

}
