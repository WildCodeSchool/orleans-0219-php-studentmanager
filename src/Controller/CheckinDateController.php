<?php

namespace App\Controller;

use App\Entity\Attendance;
use App\Form\AttendanceType;
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
    public function index(Request $request, EntityManagerInterface $entityManager) : Response
    {
        $attendances = new Attendance();
        $form = $this->createForm(AttendanceType::class, $attendances);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $attendances->setDate(new \DateTime());
            $attendances->setUser($this->getUser());


            $entityManager->persist($attendances);
            $entityManager->flush();

            return $this->redirectToRoute('checkin_date');
        }

        return $this->render('checkin_date/index.html.twig', [
            'form'=>$form->createView()
        ]);
    }
}
