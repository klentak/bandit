<?php

namespace App\Controller;

use App\Entity\User;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Routing\Annotation\Route;


/**
  *
  * @IsGranted("ROLE_USER")
  */
class GameController extends AbstractController
{
    /**
     * @Route("/game", name="game", options={"expose"=true})
     */
    public function game(Request $request)
    {
        return $this->render('game/game.html.twig');
    }

    /**
     * @Route("game/UserEdit", name="__UserEdit")
     */
    public function Edit(Request $request)
    {
        return $this->render('game/edit.html.twig');
    }
}
