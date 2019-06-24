<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CheckinDateController extends AbstractController
{
    /**
     * @Route("/checkin/date", name="checkin_date")
     */
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $presences = new presence();
        $form = $this->createForm(PresenceType::class, $presences);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $presences->setDate(new \DateTime());
            $presences->setUser($this->getUser());
            $entityManager->persist($presences);
            $entityManager->flush();
            return $this->redirectToRoute('checkin_date');
        }
        return $this->render('checkin_date/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}