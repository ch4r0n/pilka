<?php

namespace Skoki\OrlikBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Skoki\OrlikBundle\Entity\News;
use Skoki\OrlikBundle\Form\Type\NewsType;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('SkokiOrlikBundle:Default:index.html.twig', array('name' => $name));
    }

    public function homepageAction()
    {
        $currentUserTime = new \DateTime();

        $matchManager = $this->get('orlik.match.manager');
        $matchList = $matchManager->getMatchRepo()->findAll();

        return $this->render('SkokiOrlikBundle:Default:homepage.html.twig', array(
            'currentDatatime' => $currentUserTime->format('Y-m-d H:i:s'),
            'matches' => $matchList
        ));
    }

    /**
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function addNewsAction(Request $request)
    {
        $news = new News();

        $form = $this->createForm(
            new NewsType(),
            $news,
            array(
                'action' => $this->generateUrl('_orlik_add_news'),
                'method' => 'POST'
            )
        );
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($form->getData());
            $em->flush();
        }
        return $this->render('SkokiOrlikBundle:Default:addNews.html.twig', array('form' => $form->createView()));
    }
}
