<?php

namespace Cup\HomeBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Cup\HomeBundle\Entity\CupTeamMatch;
use Cup\HomeBundle\Form\CupTeamMatchType;
use Cup\HomeBundle\Repository\Repository;

/**
 * cup_team_match controller.
 *
 */
class CupTeamMatchController extends Controller
{

    /**
     * Lists all cup_team_match entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository(Repository::CUP_TEAM_MATCH)->findAll();

        return $this->render('CupHomeBundle:cup_team_match:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new cup_team_match entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new CupTeamMatch();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('cup_team_match_show', array('id' => $entity->getId())));
        }

        return $this->render('CupHomeBundle:cup_team_match:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a cup_team_match entity.
    *
    * @param CupTeamMatch $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(CupTeamMatch $entity)
    {
        $form = $this->createForm(new CupTeamMatchType(), $entity, array(
            'action' => $this->generateUrl('cup_team_match_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new cup_team_match entity.
     *
     */
    public function newAction()
    {
        $entity = new CupTeamMatch();
        $form   = $this->createCreateForm($entity);

        return $this->render('CupHomeBundle:cup_team_match:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a cup_team_match entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository(Repository::CUP_TEAM_MATCH)->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find cup_team_match entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('CupHomeBundle:cup_team_match:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing cup_team_match entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository(Repository::CUP_TEAM_MATCH)->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find cup_team_match entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('CupHomeBundle:cup_team_match:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a cup_team_match entity.
    *
    * @param CupTeamMatch $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(CupTeamMatch $entity)
    {
        $form = $this->createForm(new CupTeamMatchType(), $entity, array(
            'action' => $this->generateUrl('cup_team_match_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing cup_team_match entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository(Repository::CUP_TEAM_MATCH)->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find cup_team_match entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('cup_team_match_edit', array('id' => $id)));
        }

        return $this->render('CupHomeBundle:cup_team_match:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a cup_team_match entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository(Repository::CUP_TEAM_MATCH)->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find cup_team_match entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('cup_team_match'));
    }

    /**
     * Creates a form to delete a cup_team_match entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('cup_team_match_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
