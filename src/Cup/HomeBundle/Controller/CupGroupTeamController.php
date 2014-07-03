<?php

namespace Cup\HomeBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Cup\HomeBundle\Entity\CupGroupTeam;
use Cup\HomeBundle\Form\CupGroupTeamType;
use Cup\HomeBundle\Repository\Repository;

/**
 * cup_group_team controller.
 *
 */
class CupGroupTeamController extends Controller
{

    /**
     * Lists all cup_group_team entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository(Repository::CUP_GROUP_TEAM)->findAll();
//var_dump($entities);die();
        return $this->render('CupHomeBundle:cup_group_team:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new cup_group_team entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new CupGroupTeam();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('cup_group_team_show', array('id' => $entity->getId())));
        }

        return $this->render('CupHomeBundle:cup_group_team:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a cup_group_team entity.
    *
    * @param CupGroupTeam $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(CupGroupTeam $entity)
    {
        $form = $this->createForm(new CupGroupTeamType(), $entity, array(
            'action' => $this->generateUrl('cup_group_team_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new cup_group_team entity.
     *
     */
    public function newAction()
    {
        $entity = new CupGroupTeam();
        $form   = $this->createCreateForm($entity);

        return $this->render('CupHomeBundle:cup_group_team:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a cup_group_team entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository(Repository::CUP_GROUP_TEAM)->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find cup_group_team entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('CupHomeBundle:cup_group_team:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing cup_group_team entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository(Repository::CUP_GROUP_TEAM)->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find cup_group_team entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('CupHomeBundle:cup_group_team:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a cup_group_team entity.
    *
    * @param CupGroupTeam $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(CupGroupTeam $entity)
    {
        $form = $this->createForm(new CupGroupTeamType(), $entity, array(
            'action' => $this->generateUrl('cup_group_team_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing cup_group_team entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository(Repository::CUP_GROUP_TEAM)->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find cup_group_team entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('cup_group_team_edit', array('id' => $id)));
        }

        return $this->render('CupHomeBundle:cup_group_team:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a cup_group_team entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository(Repository::CUP_GROUP_TEAM)->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find cup_group_team entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('cup_group_team'));
    }

    /**
     * Creates a form to delete a cup_group_team entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('cup_group_team_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
