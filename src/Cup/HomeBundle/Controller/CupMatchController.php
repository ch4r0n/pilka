<?php

namespace Cup\HomeBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Cup\HomeBundle\Entity\CupMatch;
use Cup\HomeBundle\Entity\CupTeamMatch;
use Cup\HomeBundle\Form\CupMatchType;
use Cup\HomeBundle\Repository\Repository;

use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\Event\FilterUserResponseEvent;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\Model\UserInterface;
use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

/**
 * cup_match controller.
 *
 */
class CupMatchController extends Controller
{

    /**
     * Lists all cup_match entities.
     *
     */
    public function indexAction()
    {
        $user = $this->container->get('security.context')->getToken()->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {

        }

        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository(Repository::CUP_MATCH)->findAll();
        $matchDataProvider = $this->get('cup_match.data.provider');
        $tab = array();
        foreach($entities as $m) {
            $tab[] = $matchDataProvider->getMatchDetails($m);
        }

        $userBeatProvider = $this->get('user_beat.data.provider');
        $userBeats = $userBeatProvider->getUserBeats($user);

        return $this->render('CupHomeBundle:cup_match:index.html.twig', array(
            'entities' => $tab,
            'user'  => $user,
            'userBeats' => $userBeats
        ));
    }
    /**
     * Creates a new cup_match entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new CupMatch();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);

            $home = $em->getRepository(Repository::CUP_TEAM)->findOneById($entity->getTeamHome());
            $away = $em->getRepository(Repository::CUP_TEAM)->findOneById($entity->getTeamAway());
            $newGroupTeam1 = new CupTeamMatch();
            $newGroupTeam1->setCupTeam($home);
            $newGroupTeam1->setCupMatch($entity);
            $em->persist($newGroupTeam1);
            $newGroupTeam2 = new CupTeamMatch();
            $newGroupTeam2->setCupTeam($away);
            $newGroupTeam2->setCupMatch($entity);
            $em->persist($newGroupTeam2);

            $em->flush();

            return $this->redirect($this->generateUrl('cup_match_show', array('id' => $entity->getId())));
        }

        return $this->render('CupHomeBundle:cup_match:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a cup_match entity.
    *
    * @param CupMatch $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(CupMatch $entity)
    {
        $form = $this->createForm(new CupMatchType($this->getDoctrine()->getManager()), $entity, array(
            'action' => $this->generateUrl('cup_match_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new cup_match entity.
     *
     */
    public function newAction()
    {
        $entity = new CupMatch();
        $form   = $this->createCreateForm($entity);

        return $this->render('CupHomeBundle:cup_match:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a cup_match entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository(Repository::CUP_MATCH)->find($id);
        $matchDataProvider = $this->get('cup_match.data.provider');
        $matchData = $matchDataProvider->getMatchDetails($entity);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find cup_match entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('CupHomeBundle:cup_match:show.html.twig', array(
            'entity'      => $matchData,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing cup_match entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository(Repository::CUP_MATCH)->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find cup_match entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('CupHomeBundle:cup_match:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a cup_match entity.
    *
    * @param CupMatch $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(CupMatch $entity)
    {
        $form = $this->createForm(new CupMatchType($this->getDoctrine()->getManager()), $entity, array(
            'action' => $this->generateUrl('cup_match_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing cup_match entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository(Repository::CUP_MATCH)->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find cup_match entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('cup_match_edit', array('id' => $id)));
        }

        return $this->render('CupHomeBundle:cup_match:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a cup_match entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository(Repository::CUP_MATCH)->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find cup_match entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('cup_match'));
    }

    /**
     * Creates a form to delete a cup_match entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('cup_match_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
