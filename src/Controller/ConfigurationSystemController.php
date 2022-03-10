<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ConfigurationSystemController extends AbstractController
{
    #[Route('/configuration/system', name: 'configuration_system')]
    public function index(): Response
    {
        return $this->render('configuration_system/index.html.twig', [
            'controller_name' => 'ConfigurationSystemController',
        ]);
    }
}
