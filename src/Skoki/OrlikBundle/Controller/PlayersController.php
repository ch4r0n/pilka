<?php

namespace Skoki\OrlikBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Skoki\OrlikBundle\Entity\Players;
use Skoki\OrlikBundle\Form\PlayersType;

/**
 * Players controller.
 *
 */
class PlayersController extends Controller
{

    /**
     * Lists all Players entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SkokiOrlikBundle:Players')->findAll();

        return $this->render('SkokiOrlikBundle:Players:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Players entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Players();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('player_show', array('id' => $entity->getId())));
        }

        return $this->render('SkokiOrlikBundle:Players:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a Players entity.
    *
    * @param Players $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Players $entity)
    {
        $form = $this->createForm(new PlayersType(), $entity, array(
            'action' => $this->generateUrl('player_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Players entity.
     *
     */
    public function newAction()
    {
        $entity = new Players();
        $form   = $this->createCreateForm($entity);

        $validator = $this->get('validator');

        return $this->render('SkokiOrlikBundle:Players:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Players entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SkokiOrlikBundle:Players')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Players entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('SkokiOrlikBundle:Players:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Players entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SkokiOrlikBundle:Players')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Players entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('SkokiOrlikBundle:Players:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Players entity.
    *
    * @param Players $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Players $entity)
    {
        $form = $this->createForm(new PlayersType(), $entity, array(
            'action' => $this->generateUrl('player_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Players entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SkokiOrlikBundle:Players')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Players entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('player_edit', array('id' => $id)));
        }

        return $this->render('SkokiOrlikBundle:Players:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Players entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SkokiOrlikBundle:Players')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Players entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('player'));
    }

    /**
     * Creates a form to delete a Players entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('player_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
