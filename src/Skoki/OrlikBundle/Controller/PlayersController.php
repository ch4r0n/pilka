<?php

namespace Skoki\OrlikBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Skoki\OrlikBundle\Entity\Players;
use Skoki\OrlikBundle\Form\PlayersType;
use Imagine\Gd\Imagine;
use Imagine\Image\ImageInterface;

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
//        $form = $this->createCreateForm($entity);
        $form = $this->createForm(new PlayersType(), $entity);
        $form->handleRequest($request);
//        $cmf = $this->get('cmf_media.upload_file_helper');
//        var_dump($form->get('image')->getNormData());die();
//        var_dump($form['image']->getData());die();
//$form['image']->getData()->move($entity->getFullImagePath(), $form->get('image')->getNormData());
//        $pic = new Imagine();
//        $pic->open($form->get('image'));
//        $pic->save($entity->getFullImagePath( ));
//        print_r($pic);
//        die();
        if ($form->isValid()) {
            //var_dump($form->get('filepic'));die();
            $em = $this->getDoctrine()->getEntityManager();

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
//$im = new Imagine();
//        var_dump($im);die();
        $validator = $this->get('validator');

        return $this->render('SkokiOrlikBundle:Players:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to create a new Players entity.
     *
     */
    public function newTeamPlayersAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $team = $em->getRepository('SkokiOrlikBundle:Teams')->findOneById($id);

        $formFields = array();
        for ($i=0;$i<10;$i++) {
            $formFields[$i] = array(
                'first' => 'firstname_' . $i,
                'last' => 'lastname_' . $i
            );
        }

        if ($request->getMethod() == 'POST') {

            $fieldsList = array();
            $teamId = intval($request->request->get('team'));
            $teamActive = $em->getRepository('SkokiOrlikBundle:Teams')->findOneById($teamId);
            if ($teamActive) {
                $team = $teamActive;
                $playerManager = $this->get('orlik.players.manager');

                foreach ($formFields as $key => $name) {
                    $firstname = $request->request->get($name['first']);
                    $lastname = $request->request->get($name['last']);

                    if ($firstname != '' && $lastname != '') {
                        $fieldsList[] = array(
                            'firstname' => $firstname,
                            'lastname' => $lastname
                        );
                    }
                }

                $playerManager->createManyPlayers($team, $fieldsList);
            }
        }
        if ($team) {
            $players = $em->getRepository('SkokiOrlikBundle:Players')->getTeamPlayers($team);

        }
        if (empty($players)) {
            $players = null;
        }
        $validator = $this->get('validator');

        return $this->render('SkokiOrlikBundle:Players:teamPlayers.html.twig', array(
            'team' => $team,
            'fields' => $formFields,
            'players' => $players
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
