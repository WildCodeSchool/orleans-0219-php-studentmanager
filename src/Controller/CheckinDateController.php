<?php

namespace App\Controller;

use App\Entity\Presence;
use App\Form\PresenceType;
use App\Service\DateService;
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
    public function index(Request $request, EntityManagerInterface $entityManager, DateService $dateService): Response
    {


        $presence = new Presence();

        $form = $this->createForm(PresenceType::class, $presence);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $presence->setDate(new \DateTime());
            $presence->setUser($this->getUser());

            $isValid = true;

            if (!$dateService->isCheckinAllowed($presence->getDate())) {
                $isValid = false;
            } else {

                if ($dateService->isMorningCheckin($presence->getDate())) {
                    $presenceMorning = $this->getDoctrine()
                        ->getRepository(Presence::class)
                        ->findByRecordingDoneMorning($presence->getDate(), $presence->getUser());

                    if ($presenceMorning) {
                        $isValid = false;
                        $this->addFlash('erreur', 'Vous avez déjà signalé votre présence ce matin, au boulot!');
                    }
                } else {
                    $presenceAfternoon = $this->getDoctrine()
                        ->getRepository(Presence::class)
                        ->findByRecordingDoneAfternoon($presence->getDate(), $presence->getUser());

                    if ($presenceAfternoon) {
                        $isValid = false;
                        $this->addFlash('erreur', 'Vous avez déjà signalé votre présence cet après-midi, bonne sieste!');
                    }
                }

            }


            if ($isValid) {
                $entityManager->persist($presence);
                $entityManager->flush();
            }

            return $this->redirectToRoute('checkin_date');
        }
        return $this->render('checkin_date/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
