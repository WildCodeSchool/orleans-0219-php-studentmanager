<?php

namespace App\Controller;

use App\Entity\Presence;
use App\Form\PresenceType;
use App\Repository\PresenceRepository;
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
    public function index(
        Request $request,
        EntityManagerInterface $entityManager,
        DateService $dateService,
        PresenceRepository $presenceRepository
    ): Response {
        $presence = new Presence();

        $form = $this->createForm(PresenceType::class, $presence);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $presence->setDate(new \DateTime());
            $presence->setUser($this->getUser());
            if ($dateService->isMorningCheckin($presence->getDate())
                &&
                !empty($presenceRepository
                    ->findByRecordingDoneMorning($presence->getDate(), $presence->getUser()))
            ) {
                $this->addFlash(
                    'danger',
                    'Vous avez déjà signalé votre présence ce matin, au boulot !'
                );
            } elseif ($dateService->isAfternoonCheckin($presence->getDate())
                &&
                !empty($presenceRepository
                    ->findByRecordingDoneAfternoon($presence->getDate(), $presence->getUser()))
            ) {
                $this->addFlash(
                    'danger',
                    'Vous avez déjà signalé votre présence cet après-midi, bonne sieste !'
                );
            } elseif ($dateService->isCheckinAllowed($presence->getDate())
            ) {
            } elseif ($dateService->isCheckinAllowed($presence->getDate())
            ) {
                $entityManager->persist($presence);
                $entityManager->flush();
                $this->addFlash(
                    'success',
                    'Tu viens de signaler ta présence !'
                );
            }

            return $this->redirectToRoute('checkin_date');
        }
        return $this->render('checkin_date/index.html.twig', [
            'form' => $form->createView(),

        ]);
    }
}
