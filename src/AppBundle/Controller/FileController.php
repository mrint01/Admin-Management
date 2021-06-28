<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Fichier;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * @Route("/files")
 */
class FileController extends Controller
{
    /**
     * @Route("/", name="file")
     */
    public function IndexAction()
    {
      // if its not admin will redirect to 404 not found
      if (!$this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
            return $this->render('default/404.html.twig');
        }
        $us = $this->get('security.token_storage')->getToken()->getUser();
      $em = $this->getDoctrine()->getManager();

      $files = $em->getRepository('AppBundle:Fichier')->findAll();

      return $this->render('files/File.html.twig', array(
          'files' => $files,
          'user' => $us,
      ));


    }

    /**
     * Creates a new user entity.
     *
     * @Route("/new", name="file_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $file = new Fichier();
        $form = $this->createForm('AppBundle\Form\FichierType', $file);
        $form->handleRequest($request);
        $us = $this->get('security.token_storage')->getToken()->getUser();
        if ($form->isSubmitted() && $form->isValid()) {
          $fich = $file->getFichierUrl();
          $f =$this->generateUniqueFileName().'.'.$fich->guessExtension();
          $fil = $this->getParameter('upload');
          try {
                          $fich->move( $this->getParameter('upload'), $f);

                      } catch (FileException $e) {
                          // ... handle exception if something happens during file upload
                      }

                      $files =  ($fil."/".$f);
                      $file->setFichierUrl($files);


            $em = $this->getDoctrine()->getManager();
            $em->persist($file);
            $em->flush();

            return $this->redirectToRoute('file_show', array('id' => $file->getId()));
        }
        return $this->render('files/newFile.html.twig', array(
            'file' => $file,
            'user' =>$us,
            'form' => $form->createView(),
        ));
    }
    private function generateUniqueFileName()
       {
           // md5() reduces the similarity of the file names generated by
           // uniqid(), which is based on timestamps
           return (uniqid());
       }

    /**
     * Finds and displays a user entity.
     *
     * @Route("/{id}", name="file_show")
     * @Method("GET")
     */
    public function actAction(Fichier $file)
    {
        $deleteForm = $this->createDeleteForm($file);
        $us = $this->get('security.token_storage')->getToken()->getUser();
        return $this->render('files/showFile.html.twig', array(
            'file' => $file,
            'user' => $us,
            'delete' => $deleteForm->createView(),
        ));
    }




    /**
     * Displays a form to edit an existing user entity.
     *
     * @Route("/{id}/edit", name="file_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Fichier $file)
    {
        $deleteForm = $this->createDeleteForm($file);
        $editForm = $this->createForm('AppBundle\Form\FichiereditType', $file);
        $editForm->handleRequest($request);
        $us = $this->get('security.token_storage')->getToken()->getUser();
        if ($editForm->isSubmitted() && $editForm->isValid()) {

          $em = $this->getDoctrine()->getManager();
          $em->persist($file);
          $em->flush();

          //this is for alert msg
  /************************************/
  if ($editForm->isValid()) {
    $request->getSession()
    ->getFlashBag()
    ->add('success', 'Vos informations ont été mises à jour !');
      $url = $this->generateUrl('file_edit', array('id' => $file->getId()));
      return $this->redirect($url);
  }

  /************************************/
      return $this->redirectToRoute('file_edit', array('id' => $file->getId()));
        }
        return $this->render('files/editFile.html.twig', array(
            'file' => $file,
            'user' => $us,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }


    /**
     * Deletes a user entity.
     *
     * @Route("/{id}", name="file_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Fichier $file)
    {

        $form = $this->createDeleteForm($file);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($file);
            $em->flush();
        }

        return $this->redirectToRoute('file');
    }

    /**
     * Creates a form to delete a user entity.
     *
     * @param file $file The user entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Fichier $file)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('file_delete', array('id' => $file->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }


  }
