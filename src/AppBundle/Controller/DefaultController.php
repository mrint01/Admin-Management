<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */

    public function indexAction(Request $request, AuthenticationUtils $authenticationUtils )
    {
      $authChecker = $this->container->get('security.authorization_checker');

      $user = $this->get('security.token_storage')->getToken()->getUser();
      $em = $this->getDoctrine()->getManager();
      $users = $em->getRepository('AppBundle:Usr')->findBy([
     'id' => $user,]);
     ////////////////////////////////////////////////////
     $em = $this->getDoctrine()->getManager();
     $connection = $em->getConnection();
     $statement = $connection->prepare('SELECT id FROM users where  roles = "[ROLE_USER]" ');
     $statement->execute();
     $results = $statement->fetchAll();
     $nb_us = count($results);
     ////////////////////////////////////////////////////
     $em = $this->getDoctrine()->getManager();
     $locationRepo = $em->getRepository('AppBundle:Activite');
     $nb_act = $locationRepo->getNb();
     ////////////////////////////////////////////////////
     $gr = $this->getDoctrine()->getManager();
     $locationgr = $gr->getRepository('AppBundle:Grammer');
     $nb_gr = $locationgr->getNb();
     ////////////////////////////////////////////////////
     $mot = $this->getDoctrine()->getManager();
     $locationmot = $mot->getRepository('AppBundle:Mot');
     $nb_mot = $locationmot->getNb();
     //////////////////////////////////////////////////////
     $emop = $this->getDoctrine()->getManager();
     $locationRepose = $emop->getRepository('AppBundle:Fichier');
     $nb_fich = $locationRepose->getNb();
     ////////////////////////////////////////////////////
     $em = $this->getDoctrine()->getManager();
     $connection = $em->getConnection();
     $statement = $connection->prepare('SELECT id FROM fichier where  fichier_traite = "1" ');
     $statement->execute();
     $results = $statement->fetchAll();
     $nb_fich_t = count($results);
     ////////////////////////////////////////////////////
     $ex = $this->getDoctrine()->getManager();
     $locationex = $ex->getRepository('AppBundle:Historique');
     $nb_ex = $locationex->getNb();
     ////////////////////////////////////////////////////
     $ind = $this->getDoctrine()->getManager();
     $locationind = $ind->getRepository('AppBundle:Indexe');
     $nb_mot_ind = $locationind->getNb();
     ////////////////////////////////////////////////////

      if($authChecker->isGranted(['ROLE_ADMIN']))
      {
        return $this->render('settingAdmin/profiladmin.html.twig' , array(
          'user' => $user,
          'nb_us' => $nb_us,
          'nb_act' => $nb_act,
          'nb_gr' => $nb_gr,
          'nb_mot' => $nb_mot,
          'nbr_fich' => $nb_fich,
          'nb_ex' => $nb_ex,
          'nb_fich_t' =>$nb_fich_t,
      ));
      }

      else if ($authChecker->isGranted(['ROLE_USER']))
      {

        return $this->render('userfiles/Dashboard_user.html.twig' , array(
          'user' => $user,
          'nb_ex' =>$nb_ex,
          'nb_fich' => $nb_fich,
          'nb_mot_ind' => $nb_mot_ind,
        ));
      }
      else {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();
        return $this->render('default/login.html.twig', array(
            'last_username' => $lastUsername,
            'error'         => $error,
            'user' => $user,
        ));
      }
}



}
