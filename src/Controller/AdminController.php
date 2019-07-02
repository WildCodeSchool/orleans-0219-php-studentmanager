<?php

namespace App\Controller;

use App\Repository\StudentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin", name="admin")
 */
class AdminController extends AbstractController
{
    /**
     * @Route("/overview", name="_overview")
     */
    public function overview(StudentRepository $studentRepository)
    {
        return $this->render('admin/overview.html.twig', [
            'students' => $studentRepository->findAll(),
        ]);
    }

}
