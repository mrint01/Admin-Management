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
 * @Route("profil_user")
 */
class ProfilUserController extends Controller
{
    /**
     * @Route("/" , name="profil_user")
     */
    public function IndexAction()
    {

      $user = $this->get('security.token_storage')->getToken()->getUser();
      $em = $this->getDoctrine()->getManager();
      $users = $em->getRepository('AppBundle:Usr')->findBy([
     'id' => $user,]);
        return $this->render('userfiles/profil_user.html.twig', array(
          'user' => $user,
          'users' => $users,
      ));

    }


    /**
    *
    *
    * @Route("/edituser", name="edit_us")
    * @Method({"GET", "POST"})
    */
    public function editAction(Request $request)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository('AppBundle:Usr')->findBy([
        'id' => $user,]);
        $editForm = $this->createForm('AppBundle\Form\ProfiluserType', $user);
        $editForm->handleRequest($request);
        if ($editForm->isSubmitted() && $editForm->isValid()) {
          $em->persist($user);
          $em->flush();

          //this is for alert msg
  /************************************/
          if ($editForm->isValid()) {
            // .. code that saves the user
          $request->getSession()
          ->getFlashBag()
          ->add('success', 'Vos informations ont été mises à jour
 
');
          $url = $this->generateUrl('edit_us');
          return $this->redirect($url);
    }

  /************************************/

          return $this->redirectToRoute('edit_us');
        }

        return $this->render('userfiles/EditUser.html.twig', array(
            'user' => $user,
            'edit_form' => $editForm->createView(),
        ));
    }

    /**
    * Matches /password exactly
    *
    * @Route("/pass", name="pass")
    * @Method({"GET", "POST"})
    */
    public function editActionpassword(Request $request)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository('AppBundle:Usr')->findBy([
        'id' => $user,]);
        $editForm = $this->createForm('AppBundle\Form\PassType', $user);
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
    ->add('success', 'Votre mot de passe a été mis à jour!');


    $url = $this->generateUrl('pass');

    return $this->redirect($url);
  }

  /************************************/
          return $this->redirectToRoute('profil_user');
        }

        return $this->render('userfiles/securityPassword.html.twig', array(
            'users' => $users,
            'user' => $user,
            'edit_form' => $editForm->createView(),
        ));
    }




}
