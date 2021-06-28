<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class HistoryController extends Controller
{

    /**
     * @Route("/history" , name="his")
     */
    public function IndexAction()
    {


      $user = $this->get('security.token_storage')->getToken()->getUser();
      $em = $this->getDoctrine()->getManager();
      $users = $em->getRepository('AppBundle:Usr')->findBy([
     'id' => $user,]);

     $em = $this->getDoctrine()->getManager();

     $dates = $em->getRepository('AppBundle:Historique')->findAll();
     return $this->render('userfiles/historique.html.twig' , array(
       'user' => $user,
        'dates' =>$dates,));

    }

}
