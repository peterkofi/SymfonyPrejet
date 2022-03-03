<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ZoneDeSanteController extends AbstractController
{
    #[Route('/zone/de/sante', name: 'zone_de_sante')]
    public function index(): Response
    {
        return $this->render('zone_de_sante/index.html.twig', [
            'controller_name' => 'ZoneDeSanteController',
        ]);
    }
}
