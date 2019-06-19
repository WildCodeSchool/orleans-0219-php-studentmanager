<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TodayController extends AbstractController
{
    /**
     * @Route("/today", name="today")
     */
    public function index()
    {
        return $this->render('today/index.html.twig', [
            'controller_name' => 'TodayController',
        ]);
    }
}
