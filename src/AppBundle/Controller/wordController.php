<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Mot;
use AppBundle\Entity\Activite;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
/**
 * User controller.
 *
 * @Route("word")
 */

class wordController extends Controller
{
    /**
     * @Route("/", name="words")
     */
    public function IndexAction()
    {
      // if its not admin will redirect to 404 not found
      if (!$this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
            return $this->render('default/404.html.twig');
        }
        $us = $this->get('security.token_storage')->getToken()->getUser();

      $em = $this->getDoctrine()->getManager();

      $words = $em->getRepository('AppBundle:Mot')->findAll();

      return $this->render('words/word.html.twig', array(
          'words' => $words,
          'user' => $us,
      ));

    }

    /**
     * Creates a new user entity.
     *
     * @Route("/new", name="words_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
      // if its not admin will redirect to 404 not found
      if (!$this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
            return $this->render('default/404.html.twig');
        }
        $us = $this->get('security.token_storage')->getToken()->getUser();
        $words = new Mot();
        $form = $this->createForm('AppBundle\Form\WordType', $words);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($words);
            $em->flush();

            return $this->redirectToRoute('words_show', array('id' => $words->getId()));
        }


        return $this->render('words/newWords.html.twig', array(
            'words' => $words,
            'user' => $us,
            'form' => $form->createView(),
        ));
    }


    /**
     *
     *
     * @Route("/{id}", name="words_show")
     * @Method("GET")
     */
    public function showAction(Mot $word)
    {
      // if its not admin will redirect to 404 not found
      if (!$this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
            return $this->render('default/404.html.twig');
        }
        $us = $this->get('security.token_storage')->getToken()->getUser();
       $deleteForm = $this->createDeleteForm($word);
        return $this->render('words/showWords.html.twig', array(
            'word' => $word,
            'user' => $us,
            'delete_form' => $deleteForm->createView(),
        ));
    }



    /**
     * Displays a form to edit an existing user entity.
     *
     * @Route("/{id}/edit", name="words_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Mot  $words)
    {
      // if its not admin will redirect to 404 not found
      if (!$this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
            return $this->render('default/404.html.twig');
        }
        $us = $this->get('security.token_storage')->getToken()->getUser();
        $deleteForm = $this->createDeleteForm($words);
        $editForm = $this->createForm('AppBundle\Form\WordType', $words);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {

          $em = $this->getDoctrine()->getManager();
          $em->persist($words);
          $em->flush();

          //this is for alert msg
  /************************************/
  if ($editForm->isValid()) {
    $request->getSession()
    ->getFlashBag()
    ->add('success', 'Vos informations ont été mises à jour !');
      $url = $this->generateUrl('words_edit', array('id' => $words->getId()));
      return $this->redirect($url);
  }

  /************************************/
      return $this->redirectToRoute('words_edit', array('id' => $words->getId()));
        }
        return $this->render('words/editWords.html.twig', array(
            'words' => $words,
            'user' => $us,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a user entity.
     *
     * @Route("/{id}", name="user_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Mot $word)
    {
        $form = $this->createDeleteForm($word);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($word);
            $em->flush();
        }

        return $this->redirectToRoute('words');
    }

    /**
     * Creates a form to delete a user entity.
     *
     * @param Mot $user The user entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Mot $word)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('user_delete', array('id' => $word->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
