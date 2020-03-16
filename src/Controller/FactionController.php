<?php

namespace App\Controller;

use App\Entity\Faction;
use App\Form\NewFactionType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FactionController extends AbstractController
{

    /**
     * @Route("/faction", name="faction")
     */
    public function index (Request $request)
    {

      $faction = new Faction();
      $form = $this->createForm(NewFactionType::class, $faction);
      $form->handleRequest($request);

      if ($form->isSubmitted() && $form->isValid()) {

          $entityManager = $this->getDoctrine()->getManager();
          $entityManager->persist($faction);
          $entityManager->flush();

          // do anything else you need here, like send an email

          // return $this->redirectToRoute('');
      }

        return $this->render('faction/newFaction.html.twig', [
            'newFaction' => $form->createView(),
        ]);
    }

}
