<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MonthlyDelaysCounterController extends AbstractController
{
    /**
     * @Route("/monthly/delays/counter", name="monthly_delays_counter")
     */
    public function index()
    {
        return $this->render('monthly_delays_counter/index.html.twig', [
            'controller_name' => 'MonthlyDelaysCounterController',
        ]);
    }
}
