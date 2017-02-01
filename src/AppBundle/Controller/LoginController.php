<?php

namespace AppBundle\Controller;

use AppBundle\Form\LoginForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;


class LoginController extends Controller
{
    /**
     *
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/login", name="security_login")
     */
    public function loginAction()
    {
        $authenticationUtils = $this->get('security.authentication_utils');

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        $form = $this->createForm(LoginForm::class, [
        '_email' => $lastUsername,
        ]);

        return $this->render('security/loginForm.html.twig',
            array(
                'form' => $form->createView(),
                'error' => $error
            ));
    }

    /**
     * @return RedirectResponse
     * @Route ("/logout", name="security_logout")
     */
    public function logoutAction()
    {

    }

    /**
     * @Route ("/loginsuccess", name="security_loginsuccess")
     */
    public function loginsuccessAction(){

        $url = 'homepage';

        if($this->isGranted('ROLE_ADMIN')){
            $url = 'admin_page';
        }
        elseif ($this->isGranted('ROLE_USER')){
            $url = 'client_page';
        }

        return $this->redirectToRoute($url);
    }
}
