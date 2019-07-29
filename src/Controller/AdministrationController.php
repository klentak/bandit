<?php

namespace App\Controller;

use App\Entity\User;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\HttpFoundation\Request;


/**
 * @IsGranted("ROLE_ADMIN")
 */
class AdministrationController extends AbstractController
{
    /**
     * @Route("/administration", name="administration")
     */
    public function index()
    {
        $user = $this->getDoctrine()->getRepository(User::class)->findAll();

        return $this->render('administration/index.html.twig', [
            'holder' => $user,
        ]);
    }

    /**
     * @Route("/administration/delete/{id}", methods={"DELETE"})
     */
    public function delete(Request $request, $id)
    {
        $user = $this->getDoctrine()->getRepository
        (User::class)->find($id);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($user);
        $entityManager->flush();

        $response = new Response();
        $response->send();
    }

    /**
     * @Route("administration/role/{id}/{role}")
     */
    public function role(Request $request, $id, $role)
    {
        $user = $this->getDoctrine()->getRepository
        (User::class)->find($id);

        if ($role == 0)
        {
            $user->setRoles(['ROLE_ADMIN']);
        }
        else if ($role == 1)
        {
            $user->setRoles(['ROLE_USER']);
        }

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->flush();
        $response = new Response();
        $response->send();

    }

}
