<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\GameHistory;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Validator\Constraints\DateTime;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;




/**
  *
  * @IsGranted("ROLE_USER")
  */
class GameController extends AbstractController
{
    /**
     * @Route("/game", name="game", options={"expose"=true})
     */
    public function game(UserInterface $user)
    {

        return $this->render('game/game.html.twig');
    }

    /**
     * @Route("/game/UserEdit", name="__UserEdit")
     */
    public function Edit(UserInterface $user)
    {
        $user = $this->getDoctrine()->getRepository(User::class)->find($user->getId());

        $history = $user->getGameHistories();


        return $this->render('game/edit.html.twig', [
            'history' => $history
        ]);
    }

    /**
     * @Route("/game/save_result", options={"expose"=true}, methods={"POST"})
     * @package Request $request
     */
    public function save_result(Request $request, UserInterface $user)
    {
        if($request->isXmlHttpRequest()){

            $entityManager = $this->getDoctrine()->getManager();
            $gameHistory = new GameHistory();
            $user = $this->getDoctrine()->getRepository(User::class)->find($user->getId());

            $gameHistory->setNumbers($request->request->get('numbers'));
            $gameHistory->setResult($request->request->get('result'));
            $gameHistory->setDate(new \DateTime());

            $gameHistory->setUserId($user);
            $score = $user->getScore();
            $bid = $request->request->get('bid');

            if($request->request->get('result') === 'false'){
                $gameHistory->setScore($score - $bid);
                $user->setScore($score - $bid);
                $gameHistory->setReward(($bid)*-1);
                $gameHistory->setResult(false);
            }else{
                $gameHistory->setScore($score + ($bid * 100));
                $user->setScore($score + ($bid * 100));
                $gameHistory->setReward($bid * 100);
                $gameHistory->setResult(true);
            }

            $entityManager->persist($gameHistory);
            $entityManager->persist($user);
            $entityManager->flush();

            return new JsonResponse([
                'success' => 1
            ]);
        }
    }

    /**
     * @Route("/game/get_score", options={"expose"=true}, methods={"POST"})
     * @package Request $request
     */
    public function get_score(Request $request, UserInterface $user){
        if($request->isXmlHttpRequest()){

            $user = $this->getDoctrine()->getRepository(User::class)->find($user->getId());
            return new JsonResponse([
                'score' => $user->getScore()
            ]);
        }
    }
}
