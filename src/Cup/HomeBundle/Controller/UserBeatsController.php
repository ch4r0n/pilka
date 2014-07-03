<?php

namespace Cup\HomeBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Cup\HomeBundle\Entity\UserBeats;
use Cup\HomeBundle\Form\UserBeatsType;
use Cup\HomeBundle\Repository\Repository;
use Skoki\UserBundle\Entity\User;

/**
 * UserBeats controller.
 *
 */
class UserBeatsController extends Controller
{

    /**
     * Lists all UserBeats entities.
     *
     */
    public function indexAction()
    {
        $user = $this->container->get('security.context')->getToken()->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {

        }
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository(Repository::USER_BEATS)->findBy(array(
            'cupUser' => $user->getId()
        ));

        $tab = array();
        $matchDataProvider = $this->get('cup_match.data.provider');
        foreach ($entities as $userBeat) {
            $tab[] = $userBeat->setCupMatch($matchDataProvider->getMatchDetails($userBeat->getCupMatch()));
        }
//var_dump($tab);die();
        return $this->render('CupHomeBundle:UserBeats:index.html.twig', array(
            'entities' => $tab,
        ));
    }

    /**
     * Lists all UserBeats entities.
     *
     */
    public function userListAction()
    {
        $user = $this->container->get('security.context')->getToken()->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {

        }
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository(Repository::USER_BEATS)->findAll();
        $users = $em->getRepository(Repository::CUP_USER)->findAll();

        $tab = array();
        $matchDataProvider = $this->get('cup_match.data.provider');
        foreach ($entities as $userBeat) {
            $tab[] = $userBeat->setCupMatch($matchDataProvider->getMatchDetails($userBeat->getCupMatch()));
        }

        return $this->render('CupHomeBundle:UserBeats:listUser.html.twig', array(
            'entities' => $tab,
            'users' => $users
        ));
    }
    /**
     * Creates a new UserBeats entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new UserBeats();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('userbeats_show', array('id' => $entity->getId())));
        }

        return $this->render('CupHomeBundle:UserBeats:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a UserBeats entity.
    *
    * @param UserBeats $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(UserBeats $entity)
    {
        $user = $this->container->get('security.context')->getToken()->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {

        }

        $form = $this->createForm(new UserBeatsType($this->getDoctrine()->getManager(), $user), array(
            'action' => $this->generateUrl('userbeats_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new UserBeats entity.
     *
     */
    public function newAction()
    {
        $entity = new UserBeats();
        $form   = $this->createCreateForm($entity);

        return $this->render('CupHomeBundle:UserBeats:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a UserBeats entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository(Repository::USER_BEATS)->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find UserBeats entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('CupHomeBundle:UserBeats:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Finds and displays a UserBeats entity.
     *
     */
    public function showUserAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository(Repository::CUP_USER)->findOneById($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find UserBeats entity.');
        }

        return $this->render('CupHomeBundle:UserBeats:showUser.html.twig', array(
            'entity'      => $entity,
        ));
    }

    /**
     * Displays a form to edit an existing UserBeats entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository(Repository::USER_BEATS)->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find UserBeats entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('CupHomeBundle:UserBeats:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a UserBeats entity.
    *
    * @param UserBeats $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(UserBeats $entity)
    {
        $user = $this->container->get('security.context')->getToken()->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {

        }
        $form = $this->createForm(new UserBeatsType($this->getDoctrine()->getManager(),$user), $entity, array(
            'action' => $this->generateUrl('userbeats_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    /**
     * Edits an existing UserBeats entity.
     *
     */
    public function beatAction(Request $request)
    {
        $user = $this->container->get('security.context')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
        if (!is_object($user) || !$user instanceof UserInterface) {

        }
        $matches = $em->getRepository(Repository::CUP_MATCH)->findAll();
        $matchMapTab = array();
        foreach ($matches as $match) {
            $matchMapTab[$match->getId()] = $match;
        }
        $typy = $request->request->get('match');
        foreach ($typy as $id => $typ) {
            if ($typ !== '') {
                $newBeat = new UserBeats();
                $newBeat->setCupUser($user->getId());
                $newBeat->setCupMatch($matchMapTab[$id]);
                $newBeat->setCupBeat(intval($typ));
                $em->persist($newBeat);
            }
        }
        $em->flush();

        if (!$user) {
            throw $this->createNotFoundException('Unable to find UserBeats entity.');
        }

        return $this->redirect($this->generateUrl('userbeats'));
    }
    /**
     * Edits an existing UserBeats entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository(Repository::USER_BEATS)->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find UserBeats entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('userbeats_edit', array('id' => $id)));
        }

        return $this->render('CupHomeBundle:UserBeats:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a UserBeats entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository(Repository::USER_BEATS)->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find UserBeats entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('userbeats'));
    }

    /**
     * Creates a form to delete a UserBeats entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('userbeats_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
