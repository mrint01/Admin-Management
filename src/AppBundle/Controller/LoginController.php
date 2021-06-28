<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Request;


class LoginController extends Controller
{


    /**
     * @Route("/login", name="login")
     */
    public function LoginAction(Request $request, AuthenticationUtils $authenticationUtils)
  {

      // get the login error if there is one
      $error = $authenticationUtils->getLastAuthenticationError();

      // last username entered by the user
      $lastUsername = $authenticationUtils->getLastUsername();
      return $this->render('default/login.html.twig', array(
          'last_username' => $lastUsername,
          'error'         => $error,
      ));

  }

    /**
     * @Route("/logout" , name="logout")
     */
    public function LogoutAction()
    {
        return null;
    }

}
