<?php

namespace App\Controller;

use App\Entity\Coaster;
use App\Form\CoasterType;
use App\Repository\CategoryRepository;
use App\Repository\CoasterRepository;
use App\Repository\ParkRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CoasterController extends AbstractController
{
    #[Route('/coaster/')]
    public function index(
        CoasterRepository $coasterRepository,
        ParkRepository $parkRepository,
        CategoryRepository $categoryRepository,
        Request $request
    ): Response
    {
        $parkId = (int) $request->get('park', ''); // '' en int = 0
        $categoryId = (int) $request->get('category', '');
        $search = $request->get('search', '');

        $itemCount = 10;
        $page = $request->get('p', 1); // coaster?p=2
        $begin = ($page - 1) * $itemCount;

        $coasters = $coasterRepository->findFiltered($parkId, $categoryId, $search, $begin, $itemCount);
        //$coasterRepository = $em->getRepository(Coaster::class)->findAll();

        dump($coasters);

        $pageCount = max(ceil($coasters->count() / $itemCount), 1);

        return $this->render('coaster/index.html.twig', [
            'coasters' => $coasters,
            'parks' => $parkRepository->findAll(),
            'categories' => $categoryRepository->findAll(),
            'pageCount' => $pageCount,
        ]);
    }

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

    #[Route('/coaster/{id}/delete')]
    public function delete(Coaster $coaster, Request $request, EntityManagerInterface $em): Response
    {
        if ($this->isCsrfTokenValid(
            'delete'.$coaster->getId(),
            $request->request->get('_token')
        )) {
            $em->remove($coaster);
            $em->flush();
        
            return $this->redirectToRoute('app_coaster_index');
        }
        
        return $this->render('coaster/delete.html.twig', [
            'coaster' => $coaster,
        ]);
    }
}