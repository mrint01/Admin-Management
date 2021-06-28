<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Indexe;
use AppBundle\Entity\Usr;
use AppBundle\Entity\Fichier;
use AppBundle\Entity\Mot;
use AppBundle\Entity\Activite;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Session\Session;
use \stdClass;

/**
 * User controller.
 *
 * @Route("us")
 */
class ResController extends Controller
{
    /**
     * @Route("/resultat" , name="usres")
     */
    public function IndexAction()
    {

      //////////////////////////////////////////////////////
      $us = [$this->get('security.token_storage')->getToken()->getUser()];
      $act=[];
      foreach ($us as $value) {

        $act[$value->getId()]['activite']=$s=$value->getactivite();

      }
      ////////////////////////////////////////////
      $user = $this->get('security.token_storage')->getToken()->getUser();


        $em = $this->getDoctrine()->getManager();
        $resultats = $em->getRepository('AppBundle:Indexe')->findby(['act' => $s]);
        $viewResults = [];
        $tmpAr = [];
        $res = [];
        foreach ($resultats as $result) {

          $tmpAr[$result->getIndexeFichier()->getFichierUrl()][]=$result->getIndexeMot()->getMotValeur();
          $viewResults[$result->getIndexeFichier()->getFichierUrl()]['motValeurs'] = join(",",$tmpAr[$result->getIndexeFichier()->getFichierUrl()]);
          $viewResults[$result->getIndexeFichier()->getFichierUrl()]['ind'] = $result->getId();
      }
      foreach ($viewResults as $key => $value) {
        $o = new \stdClass();
        $o->fichier = $key;
        $o->mot = $value['motValeurs'];
        $o->ind = $value['ind'];
        $res[] = $o;
      }




      $em = $this->getDoctrine()->getManager();
      $resultats = $em->getRepository('AppBundle:Indexe')->findAll();

      return $this->render('userfiles/result.html.twig', array(
          'resultats' => $res,
      ));

    }

}
