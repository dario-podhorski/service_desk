<?php
/**
 * Created by PhpStorm.
 * User: pole
 * Date: 24.01.17.
 * Time: 15:15
 */
namespace AppBundle\Security;

use AppBundle\Form\LoginForm;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\Authenticator\AbstractFormLoginAuthenticator;
use Symfony\Component\HttpFoundation\RedirectResponse;

class LoginFormAuthenticator extends AbstractFormLoginAuthenticator{

    private $formFactory;
    private $em;
    private $router;

    public function __construct(FormFactoryInterface $formFactory, EntityManager $em, RouterInterface $router)
    {
        $this->formFactory = $formFactory;
        $this->em = $em;
        $this->router = $router;
    }


    public function getCredentials(Request $request)
    {
        $isLoginSubmit = $request->getPathInfo() == '/login' && $request->isMethod('POST');

        if (!$isLoginSubmit){
            return;
        }

        $form = $this->formFactory->create(LoginForm::class);
        $form->handleRequest($request);

        $data = $form->getData();

        return $data;
    }

    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        $username = $credentials['_email'];

        return $this->em->getRepository('AppBundle:User')->findOneBy(['email' =>$username]);


    }

    public function checkCredentials($credentials, UserInterface $user)
    {
        $password = $credentials['_password'];
        $storedPassword = $user->getPassword();

        if($password == $storedPassword){
            return true;
        }

        return false;

    }

    protected function getLoginUrl()
    {
        return $this->router->generate('security_login');
    }


    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {

        $response = new RedirectResponse($this->router->generate('admin_page'));
        return $response;
    }


}