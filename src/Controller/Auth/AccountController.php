<?php

namespace App\Controller\Auth;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class AccountController extends AbstractController
{
    /**
     * @Route("/login", name="account_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        return $this->render('auth/index.html.twig', [
            'hasError' => $authenticationUtils->getLastAuthenticationError() !== null
        ]);
    }

    /**
     * @Route("/logout", name="account_logout")
     */
    public function logout()
    {
    }
}
