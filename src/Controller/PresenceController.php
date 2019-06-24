<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PresenceController extends AbstractController
{
    /**
     * @Route("/presence", name="presence")
     */
    public function index()
    {
        return $this->render('presence/index.html.twig', [
            'controller_name' => 'PresenceController',
        ]);
    }
}