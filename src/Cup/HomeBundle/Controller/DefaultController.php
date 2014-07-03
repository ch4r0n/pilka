<?php

namespace Cup\HomeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Cup\HomeBundle\Repository\Repository;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository(Repository::CUP_MATCH)->findAll();
        $matchDataProvider = $this->get('cup_match.data.provider');
        $tab = array();
        foreach($entities as $m) {
            $tab[] = $matchDataProvider->getMatchDetails($m);
        }

        return $this->render('CupHomeBundle:Default:index.html.twig', array(
            'matches' => $tab));
    }
}
