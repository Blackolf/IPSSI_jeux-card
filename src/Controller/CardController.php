<?php

namespace App\Controller;

use App\Entity\Card;
use App\Form\NewCardType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CardController extends AbstractController
{
  /**
  * @Route("/card", name="card")
  */
  public function index(Request $request)
  {
    $card = new Card();
    $form = $this->createForm(NewCardType::class, $card);
    $form->handleRequest($request);

    // c'est une appelle ajax
    if ($form->isSubmitted() && $form->isValid()) {

      $card->setIdCreator($this->getUser());

      $entityManager = $this->getDoctrine()->getManager();
      $entityManager->persist($card);
      $entityManager->flush();

      // return $this->redirectToRoute('card');
    }

    return $this->render('card/index.html.twig', [
      'newCard' => $form->createView(),
    ]);
  }
}
