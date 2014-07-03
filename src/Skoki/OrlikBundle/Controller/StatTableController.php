<?php

namespace Skoki\OrlikBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Skoki\OrlikBundle\Entity\StatTable;
use Skoki\OrlikBundle\Form\StatTableType;
use Skoki\OrlikBundle\Repository\Repository;

/**
 * StatTable controller.
 *
 */
class StatTableController extends Controller
{

    /**
     * Lists all StatTable entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SkokiOrlikBundle:StatTable')->findAll();

        return $this->render('SkokiOrlikBundle:StatTable:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new StatTable entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new StatTable();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('stats_show', array('id' => $entity->getId())));
        }

        return $this->render('SkokiOrlikBundle:StatTable:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a StatTable entity.
    *
    * @param StatTable $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(StatTable $entity)
    {
        $form = $this->createForm(new StatTableType(), $entity, array(
            'action' => $this->generateUrl('stats_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new StatTable entity.
     *
     */
    public function newAction()
    {
        $entity = new StatTable();
        $form   = $this->createCreateForm($entity);

        return $this->render('SkokiOrlikBundle:StatTable:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a StatTable entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SkokiOrlikBundle:StatTable')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find StatTable entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('SkokiOrlikBundle:StatTable:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing StatTable entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SkokiOrlikBundle:StatTable')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find StatTable entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('SkokiOrlikBundle:StatTable:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a StatTable entity.
    *
    * @param StatTable $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(StatTable $entity)
    {
        $form = $this->createForm(new StatTableType(), $entity, array(
            'action' => $this->generateUrl('stats_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing StatTable entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SkokiOrlikBundle:StatTable')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find StatTable entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('stats_edit', array('id' => $id)));
        }

        return $this->render('SkokiOrlikBundle:StatTable:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a StatTable entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SkokiOrlikBundle:StatTable')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find StatTable entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('stats'));
    }

    /**
     * Creates a form to delete a StatTable entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('stats_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
