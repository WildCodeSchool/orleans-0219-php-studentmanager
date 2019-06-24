<?php

namespace App\Controller;

use App\Repository\StudentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/admin", name="admin")
 */
class AdminController extends AbstractController
{
    /**
     * @Route("/", name="_index")
     */
    public function index(StudentRepository $studentRepository): Response
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    /**
     * @Route("/overview", name="_overview", methods={"GET"})
     */
    public function overview(StudentRepository $studentRepository)
    {
        return $this->render('admin/overview.html.twig', [
            'students' => $studentRepository->findAll(),
        ]);
    }
}
