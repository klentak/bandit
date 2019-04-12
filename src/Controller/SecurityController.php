<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


class SecurityController extends Controller
{
    /**
     * @Route("/", name="login")
     *
     */
    public function login(Request $request, AuthenticationUtils $utils)
    {


        $error = $utils->getLastAuthenticationError();

        $lastUsername = $utils->getLastUsername();


        return $this->render('security/login.html.twig', [
            'error'         => $error,
            'lastUsername'  => $lastUsername,
        ]);

    }


    /**
     * @Route("/logout", name="logout")
     */
    public function logout()
    {

    }
}
