<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;


class ContactController extends Controller
{
    /**
     * @Route("/contact" , name="contact")
     */
    public function IndexAction( Request $request , \Swift_Mailer $mailer )
    {
      $user = $this->get('security.token_storage')->getToken()->getUser();
      $em = $this->getDoctrine()->getManager();
      $users = $em->getRepository('AppBundle:Usr')->findBy([
     'id' => $user,]);
      $form = $this ->createForm('AppBundle\Form\ContactType'::class);
      $form->handleRequest($request);
      if($form->isSubmitted() && $form->isValid()){

        $contactFormData = $form->getData();
        dump($contactFormData);
        $name =$contactFormData['name'];
        $email = $contactFormData['email'];
        $msg = $contactFormData['message'];
        $ms = "Prénom : .$name. \n email : .$email. \n message : .$msg. \n";
        $message = (new \Swift_Message('vous recevez un email'))
         ->setFrom('contact@solva.tel')
         ->setTo('contact@solva.tel')
         ->setBody(
             $ms
           );

          $mailer->send($message);

          //this is for alert msg
        /************************************/
        if ($form->isValid()) {
        $request->getSession()
        ->getFlashBag()
        ->add('success', 'Votre demande a été envoyée !');
        $url = $this->generateUrl('contact');
        return $this->redirect($url);
        }

        /************************************/
      }



        return $this->render('userfiles/contact.html.twig' ,array(
        'form' => $form->createView(),
        'user' => $user,));
    }

}
