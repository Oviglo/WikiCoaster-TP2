<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AppController extends AbstractController
{
    #[Route('/')]
    public function index(): Response
    {
        // Retourne le contenu de la vue 'app/index'
        return $this->render('app/index.html.twig');
    }
}