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
 * @Route("param")
 */
class SettingAdminController extends Controller
{
  /**
  * Matches /index exactly
  *
  * @Route("/index", name="index_param")
  */
    public function IndexAction()
    {
      // if its not admin will redirect to 404 not found
      if (!$this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
            return $this->render('default/404.html.twig');
        }
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository('AppBundle:Usr')->findBy([
    'id' => $user,]);
        return $this->render('settingAdmin/paramAdmin.html.twig', array(
            'users' => $users,
            'user' => $user,
        ));
    }

    /**
    *
    *
    * @Route("/editadmin", name="edit_ad")
    * @Method({"GET", "POST"})
    */
    public function editAction(Request $request)
    {
      // if its not admin will redirect to 404 not found
      if (!$this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
            return $this->render('default/404.html.twig');
        }
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository('AppBundle:Usr')->findBy([
        'id' => $user,]);
        $editForm = $this->createForm('AppBundle\Form\ProfilAdminType', $user);
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
          ->add('success', 'Vos informations ont été mises à jour');
          $url = $this->generateUrl('edit_ad');
          return $this->redirect($url);
    }

  /************************************/

          return $this->redirectToRoute('edit_ad');
        }

        return $this->render('settingAdmin/EditInfoAdmin.html.twig', array(
            'user' => $user,
            'edit_form' => $editForm->createView(),
        ));
    }

    /**
    * Matches /password exactly
    *
    * @Route("/security", name="security")
    * @Method({"GET", "POST"})
    */
    public function editActionpassword(Request $request)
    {
      // if its not admin will redirect to 404 not found
      if (!$this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
            return $this->render('default/404.html.twig');
        }
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
    ->add('success', 'Votre mot de passe a été mis à jour !');


    $url = $this->generateUrl('security');

    return $this->redirect($url);
  }

  /************************************/
          return $this->redirectToRoute('security');
        }

        return $this->render('settingAdmin/securityPassword.html.twig', array(
            'users' => $users,
            'user' => $user,
            'edit_form' => $editForm->createView(),
        ));
    }

}
