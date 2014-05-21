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

        return $this->render('SkokiOrlikBundle:Team:Show.html.twig', array('id' => $id, 'team' => $team));
    }

    public function listAction()
    {
        $teamsList = $this->getDoctrine()
            ->getRepository(Repository::TEAMS)
            ->getListForForm();
//        var_dump($teamsList);die();
        return $this->render('SkokiOrlikBundle:Team:TeamList.html.twig', array('teamsList' => $teamsList));
    }
}
