<?php

namespace App\Controller;

use App\Entity\Coaster;
use App\Form\CoasterType;
use App\Repository\CoasterRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CoasterController extends AbstractController
{
    #[Route(path: 'coaster/add')]
    public function add(EntityManagerInterface $em, Request $request): Response
    {
        $coaster = new Coaster();
        /*$coaster->setName('Blue Fire')
            ->setLength(1056)
            ->setMaxSpeed(100)
            ->setMaxHeight(38)
            ->setOperating(true)
        ;*/

        $form = $this->createForm(CoasterType::class, $coaster);

        // Envois des données POST
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Envoi de l'entité dans le gestionnaire Doctrine
            $em->persist($coaster);

            // Met à jour la base de données
            $em->flush();

            return $this->redirectToRoute('app_coaster_index');
        }

        // return new Response("Coaster ajouté");
        return $this->render('coaster/add.html.twig', [
            'coasterForm' => $form,
        ]);
    }

    #[Route('/coaster/')]
    public function index(CoasterRepository $coasterRepository): Response
    {
        $coasters = $coasterRepository->findAll();

        dump($coasters);

        return $this->render('coaster/index.html.twig', [
            'coasters' => $coasters,
        ]);
    }

    #[Route('/coaster/{id}/edit')]
    public function edit(Coaster $coaster, Request $request, EntityManagerInterface $em): Response
    {
        dump($coaster);
        $form = $this->createForm(CoasterType::class, $coaster);

        // Envois des données POST
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // Met à jour la base de données
            $em->flush();

            return $this->redirectToRoute('app_coaster_index');
        }
        
        return $this->render('coaster/edit.html.twig', [
            'coasterForm' => $form,
        ]);
    }
}