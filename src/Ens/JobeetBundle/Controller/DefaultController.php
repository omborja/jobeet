<?php

namespace Ens\JobeetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Security\Core\Security;


class DefaultController extends Controller
{
    /**
     * @Route("/hello")
     */
    public function indexAction()
    {
        return $this->render('EnsJobeetBundle:Default:index.html.twig');
    }

    /**
     * @Route("/login", name="login")
     */
    public function loginAction()
    {
        $request = $this->get('request');
        $session = $request->getSession();

        // get the login error if there is one
        if ($request->attributes->has(Security::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(Security::AUTHENTICATION_ERROR);
        } else {
            $error = $session->get(Security::AUTHENTICATION_ERROR);
            $session->remove(Security::AUTHENTICATION_ERROR);
        }

        return $this->render('EnsJobeetBundle:Default:login.html.twig', array(
            // last username entered by the user
            'last_username' => $session->get(Security::LAST_USERNAME),
            'error'         => $error,
        ));
    }

    /**
     * @Route("/login_check", name="login_check")
     */
    public function loginCheckAction()
    {
        // this controller will not be executed,
        // as the route is handled by the Security system
        throw new \Exception('Which means that this Exception will not be raised anytime soon …');
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logoutAction()
    {
        // this controller will not be executed,
        // as the route is handled by the Security system
        throw new \Exception('Which means that this Exception will not be raised anytime soon …');
    }
}
