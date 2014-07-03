<?php

namespace Cup\HomeBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Cup\HomeBundle\Entity\CupGroup;
use Cup\HomeBundle\Form\CupGroupType;
use Cup\HomeBundle\Repository\Repository;

/**
 * CupGroup controller.
 *
 */
class CupGroupController extends Controller
{

    /**
     * Lists all cup_group entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository(Repository::CUP_GROUP)->findAll();

        return $this->render('CupHomeBundle:cup_group:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new cup_group entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new CupGroup();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('cup_group_show', array('id' => $entity->getId())));
        }

        return $this->render('CupHomeBundle:cup_group:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a cup_group entity.
    *
    * @param CupGroup $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(CupGroup $entity)
    {
        $form = $this->createForm(new CupGroupType(), $entity, array(
            'action' => $this->generateUrl('cup_group_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new cup_group entity.
     *
     */
    public function newAction()
    {
        $entity = new CupGroup();
        $form   = $this->createCreateForm($entity);

        return $this->render('CupHomeBundle:cup_group:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a cup_group entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository(Repository::CUP_GROUP)->find($id);
        $teams = $em->getRepository(Repository::CUP_GROUP_TEAM)->findBy(array('cupGroup' => $entity));

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find cup_group entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('CupHomeBundle:cup_group:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
            'teams'       => $teams));
    }

    /**
     * Displays a form to edit an existing cup_group entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository(Repository::CUP_GROUP)->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find cup_group entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('CupHomeBundle:cup_group:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a cup_group entity.
    *
    * @param CupGroup $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(CupGroup $entity)
    {
        $form = $this->createForm(new CupGroupType(), $entity, array(
            'action' => $this->generateUrl('cup_group_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing cup_group entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository(Repository::CUP_GROUP)->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find cup_group entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('cup_group_edit', array('id' => $id)));
        }

        return $this->render('CupHomeBundle:cup_group:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a cup_group entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository(Repository::CUP_GROUP)->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find cup_group entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('cup_group'));
    }

    /**
     * Creates a form to delete a cup_group entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('cup_group_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
