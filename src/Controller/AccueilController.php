<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController extends AbstractController
{
    #[Route('/', name: 'app_accueil')]
    public function index(): Response
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('app_utlisateur');
        }

        return $this->render('accueil/index.html.twig', [
            'last_username' => "", // see login
            'error' => "" // see login
        ]);
    }
}
