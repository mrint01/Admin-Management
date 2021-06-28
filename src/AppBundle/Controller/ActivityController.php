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
 * @Route("activity")
 */

class ActivityController extends Controller
{
    /**
     * @Route("/" , name="activity")
     */
    public function IndexAction()
    {
      // if its not admin will redirect to 404 not found
      if (!$this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
            return $this->render('default/404.html.twig');
        }
      $us = $this->get('security.token_storage')->getToken()->getUser();
      $em = $this->getDoctrine()->getManager();

      $activites = $em->getRepository('AppBundle:Activite')->findAll();
      return $this->render('activity/Activity.html.twig', array(
          'activites' => $activites,
          'user' => $us,
      ));

    }

    /**
     * Creates a new user entity.
     *
     * @Route("/new", name="activite_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
      // if its not admin will redirect to 404 not found
      if (!$this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
            return $this->render('default/404.html.twig');
        }
        $us = $this->get('security.token_storage')->getToken()->getUser();
        $activite = new activite();
        $form = $this->createForm('AppBundle\Form\ActivityType', $activite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($activite);
            $em->flush();

            return $this->redirectToRoute('activity_show', array('id' => $activite->getId()));
        }

        return $this->render('activity/newActivity.html.twig', array(
            'activite' => $activite,
            'user' => $us,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a user entity.
     *
     * @Route("/{id}", name="activity_show")
     * @Method("GET")
     */
    public function actAction(Activite $activite)
    {
      // if its not admin will redirect to 404 not found
      if (!$this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
            return $this->render('default/404.html.twig');
        }
        $us = $this->get('security.token_storage')->getToken()->getUser();
        $deleteForm = $this->createDeleteForm($activite);

        return $this->render('activity/showActivity.html.twig', array(
            'activite' => $activite,
            'user' => $us,
            'delete' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing user entity.
     *
     * @Route("/{id}/edit", name="activite_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Activite $activite)
    {
      // if its not admin will redirect to 404 not found
      if (!$this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
            return $this->render('default/404.html.twig');
        }
        $us = $this->get('security.token_storage')->getToken()->getUser();
        $deleteForm = $this->createDeleteForm($activite);
        $editForm = $this->createForm('AppBundle\Form\ActivityType', $activite);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {

          $em = $this->getDoctrine()->getManager();
          $em->persist($activite);
          $em->flush();

          //this is for alert msg
  /************************************/
  if ($editForm->isValid()) {
    $request->getSession()
    ->getFlashBag()
    ->add('success', 'Vos informations ont été mises à jour !');
      $url = $this->generateUrl('activite_edit', array('id' => $activite->getId()));
      return $this->redirect($url);
  }

  /************************************/
      return $this->redirectToRoute('activite_edit', array('id' => $activite->getId()));
        }
        return $this->render('activity/editActivity.html.twig', array(
            'activite' => $activite,
            'user' => $us,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }


    /**
     * Deletes a user entity.
     *
     * @Route("/{id}", name="activity_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Activite $activite)
    {
        $form = $this->createDeleteForm($activite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($activite);
            $em->flush();
        }

        return $this->redirectToRoute('activity');
    }

    /**
     * Creates a form to delete a user entity.
     *
     * @param act $activite The user entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Activite $activite)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('activity_delete', array('id' => $activite->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }


}
