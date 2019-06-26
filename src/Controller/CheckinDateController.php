<?php

namespace App\Controller;

use App\Entity\Presence;
use App\Form\PresenceType;
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


        $presence = new Presence();

        $form = $this->createForm(PresenceType::class, $presence);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $presence->setDate(new \DateTime());
            $presence->setUser($this->getUser());

            $presenceMorning = $this->getDoctrine()
                ->getRepository(Presence::class)
                ->recordingDoneMorning($presence->getDate(), $presence->getUser());

            if ($presenceMorning) {
                $this->addFlash('notice', 'Vous avez déjà signalé votre présence ce matin, au boulot!');
            }
            $presenceAfternoon = $this->getDoctrine()
                ->getRepository(Presence::class)
                ->recordingDoneAfternoon($presence->getDate(), $presence->getUser());
            //peut etre en relation avec le inner join presenceRepository

            if ($presenceAfternoon) {
                $this->addFlash('notice','Vous avez déjà signalé votre présence cet après-midi, bonne sieste!');
            }

            $entityManager->persist($presence);
            $entityManager->flush();
            return $this->redirectToRoute('checkin_date');
        }
        return $this->render('checkin_date/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
