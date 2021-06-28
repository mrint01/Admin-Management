<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Grammer;
use AppBundle\Entity\Activite;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
/**
 * User controller.
 *
 * @Route("grammer")
 */

class GrammerController extends Controller
{
    /**
     * @Route("/", name="grammer")
     */
    public function IndexAction()
    {
      // if its not admin will redirect to 404 not found
      if (!$this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
            return $this->render('default/404.html.twig');
        }
        $us = $this->get('security.token_storage')->getToken()->getUser();
      $em = $this->getDoctrine()->getManager();
      $grammers = $em->getRepository('AppBundle:Grammer')->findAll();
      return $this->render('Grammers/Grammer.html.twig', array(
          'Grammers' => $grammers,
          'user' => $us,
      ));
    }

    /**
     * Creates a new user entity.
     *
     * @Route("/new", name="grammer_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
      // if its not admin will redirect to 404 not found
      if (!$this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
            return $this->render('default/404.html.twig');
        }
        $us = $this->get('security.token_storage')->getToken()->getUser();
        $grammer = new Grammer();
        $form = $this->createForm('AppBundle\Form\GrammerType', $grammer);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($grammer);
            $em->flush();
            return $this->redirectToRoute('grammer_show', array('id' => $grammer->getId()  ));
        }
            return $this->render('Grammers/newGrammer.html.twig', array(
            'grammer' => $grammer,
            'user' =>$us,
            'form' => $form->createView(),
        ));
    }



    /**
     * Finds and displays a user entity.
     *
     * @Route("/{id}", name="grammer_show")
     * @Method("GET")
     */
    public function actAction(Grammer  $grammer)
    {
      // if its not admin will redirect to 404 not found
      if (!$this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
            return $this->render('default/404.html.twig');
        }
        $us = $this->get('security.token_storage')->getToken()->getUser();
        $deleteForm = $this->createDeleteForm($grammer);
        return $this->render('Grammers/showGrammer.html.twig', array(
            'grammer' => $grammer,
            'user' => $us,
            'delete' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing user entity.
     *
     * @Route("/{id}/edit", name="grammer_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Grammer $grammer)
    {
      // if its not admin will redirect to 404 not found
      if (!$this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
            return $this->render('default/404.html.twig');
        }

        $us = $this->get('security.token_storage')->getToken()->getUser();
        $deleteForm = $this->createDeleteForm($grammer);
        $editForm = $this->createForm('AppBundle\Form\GrammerType', $grammer);
        $editForm->handleRequest($request);
        if ($editForm->isSubmitted() && $editForm->isValid()) {

          $em = $this->getDoctrine()->getManager();
          $em->persist($grammer);
          $em->flush();

          //this is for alert msg
  /************************************/
  if ($editForm->isValid()) {
    $request->getSession()
    ->getFlashBag()
    ->add('success', 'Vos informations ont été mises à jour !');
      $url = $this->generateUrl('grammer_edit', array('id' => $grammer->getId()));
      return $this->redirect($url);
  }

  /************************************/
      return $this->redirectToRoute('grammer_edit', array('id' => $grammer->getId()));
        }
        return $this->render('Grammers/editGrammer.html.twig', array(
            'grammer' => $grammer,
            'user' => $us,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a user entity.
     *
     * @Route("/{id}", name="grammer_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Grammer $grammer)
    {
        $form = $this->createDeleteForm($grammer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($grammer);
            $em->flush();
        }

        return $this->redirectToRoute('grammer');
    }

    /**
     * Creates a form to delete a user entity.
     *
     * @param grammer $grammer The user entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Grammer $grammer)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('grammer_delete', array('id' => $grammer->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }




}
