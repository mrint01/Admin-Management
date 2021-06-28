<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class histController extends Controller
{

    /**
     * @Route("/histor" , name="histor")
     */
    public function IndexAction()
    {


      $user = $this->get('security.token_storage')->getToken()->getUser();
      $em = $this->getDoctrine()->getManager();
      $users = $em->getRepository('AppBundle:Usr')->findBy([
     'id' => $user,]);

     $em = $this->getDoctrine()->getManager();

     $dates = $em->getRepository('AppBundle:Historique')->findAll();
     return $this->render('history/his.html.twig' , array(
       'user' => $user,
        'dates' =>$dates,));

    }

}
