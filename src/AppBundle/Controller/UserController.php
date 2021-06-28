<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Usr;
use AppBundle\Entity\Activite;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * User controller.
 *
 * @Route("user")
 */
class UserController extends Controller
{



     /**
      * Lists all user entities.
      *
      * @Route("/", name="user_index")
      * @Method("GET")
      */
    public function indexAction()
    {
      // if its not admin will redirect to 404 not found
      if (!$this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
            return $this->render('default/404.html.twig');
        }

        $user = $this->get('security.token_storage')->getToken()->getUser();

        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository('AppBundle:Usr')->findAll();

        return $this->render('user/index.html.twig', array(
            'users' => $users,
            'user' => $user,
        ));
    }



    /**
     * Creates a new user entity.
     *
     * @Route("/new", name="user_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
      // if its not admin will redirect to 404 not found
      if (!$this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
            return $this->render('default/404.html.twig');
        }
        $us = $this->get('security.token_storage')->getToken()->getUser();

        $user = new Usr();
        $form = $this->createForm('AppBundle\Form\UserType', $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $encoder = $this->container->get('security.password_encoder');
            $encoded = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($encoded);



            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('user_show', array('id' => $user->getId()));
        }


        return $this->render('user/new.html.twig', array(
            'user' => $user,
            'user' => $us,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a user entity.
     *
     * @Route("/{id}", name="user_show")
     * @Method("GET")
     */
    public function showAction(Usr $user)
    {

      // if its not admin will redirect to 404 not found
      if (!$this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
            return $this->render('default/404.html.twig');
        }
        $us = $this->get('security.token_storage')->getToken()->getUser();
       $deleteForm = $this->createDeleteForm($user);
        return $this->render('user/show.html.twig', array(
            'users' => $user,
            'user' => $us,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing user entity.
     *
     * @Route("/{id}/edit", name="user_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Usr $user)
    {
      // if its not admin will redirect to 404 not found
      if (!$this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
            return $this->render('default/404.html.twig');
        }
        $deleteForm = $this->createDeleteForm($user);
        $editForm = $this->createForm('AppBundle\Form\UserType', $user);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {


          $em = $this->getDoctrine()->getManager();
          $encoder = $this->container->get('security.password_encoder');
          $encoded = $encoder->encodePassword($user, $user->getPassword());
          $user->setPassword($encoded);
          $em->persist($user);
          $em->flush();

          //this is for alert msg
  /************************************/
  if ($editForm->isValid()) {
    $request->getSession()
    ->getFlashBag()
    ->add('success', 'Vos informations ont été mises à jour !');


    $url = $this->generateUrl('user_edit', array('id' => $user->getId()));

    return $this->redirect($url);
  }

  /************************************/



            return $this->redirectToRoute('user_edit', array('id' => $user->getId()));
        }



        return $this->render('user/edit.html.twig', array(
            'user' => $user,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a user entity.
     *
     * @Route("/{id}", name="user_d")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Usr $user)
    {
        $form = $this->createDeleteForm($user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($user);
            $em->flush();
        }

        return $this->redirectToRoute('user_index');
    }

    /**
     * Creates a form to delete a user entity.
     *
     * @param Adm $user The user entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Usr $user)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('user_d', array('id' => $user->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }



}
