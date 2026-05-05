<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AccueilController extends AbstractController
{
    #[Route('/accueil', name: 'app_accueil')]
    public function index(): Response
    {
        return $this->render('accueil/index.html.twig', [
            'controller_name' => 'AccueilController',
        ]);
    }
}
#[Route('/bonjour/{aziz}', name: 'app_bonjour')]
public function bonjour(string $aziz): Response 
{
    return new Response("<h1>Bonjour $aziz ! Bienvenue sur Symfony 7.4</h1>");
}
