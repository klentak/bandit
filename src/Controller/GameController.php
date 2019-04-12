<?php

namespace App\Controller;

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
     * @Route("/game", name="game")
     */
    public function game(Request $request)
    {

        $form = $this->createFormBuilder()
            ->add('raffle', SubmitType::class, array(
                'label' => 'losuj',
                'attr' => array('class' => 'btn btn-primary mt-3')))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted())
        {
            $number1 = random_int(0, 9);
            $number2 = random_int(0, 9);
            $number3 = random_int(0, 9);

            return $this->render('game/game.html.twig', array(
                'form'      => $form->createView(),
                'number1'   => $number1,
                'number2'   => $number2,
                'number3'   => $number3,
                ));

        }

        return $this->render('game/game.html.twig', array(
            'form' => $form->createView(),
            'number1'   => 0
        ));
    }
}
