<?php

namespace App\Controller;

use App\Entity\Coaster;
use App\Form\CoasterType;
use App\Repository\CategoryRepository;
use App\Repository\CoasterRepository;
use App\Repository\ParkRepository;
use App\Security\Voter\CoasterVoter;
use App\Service\FileUploaderInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

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
        $search = (string) $request->get('search', '');

        $itemCount = 10;
        $page = $request->get('p', 1); // coaster?p=2
        $begin = ($page - 1) * $itemCount;

        $coasters = $coasterRepository->findFiltered($parkId, $categoryId, $search, $begin, $itemCount);
        //$coasterRepository = $em->getRepository(Coaster::class)->findAll();

        // dump($coasters);

        $pageCount = max(ceil($coasters->count() / $itemCount), 1);

        return $this->render('coaster/index.html.twig', [
            'coasters' => $coasters,
            'parks' => $parkRepository->findAll(),
            'categories' => $categoryRepository->findAll(),
            'pageCount' => $pageCount,
        ]);
    }

    #[Route(path: 'coaster/add')]
    #[IsGranted('ROLE_USER')]
    public function add(
        EntityManagerInterface $em,
        Request $request,
        FileUploaderInterface $fileUploader
    ): Response
    {
        $user = $this->getUser();

        $coaster = new Coaster();
        $coaster->setAuthor($user);
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
            // Retourne la donnée du champ "image"
            $imageFile = $form->get('image')->getData();
            if ($imageFile) {
                $fileName = $fileUploader->upload($imageFile);
                $coaster->setImageFileName($fileName);
            }

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
    #[IsGranted('ROLE_USER')]
    public function edit(
        Coaster $coaster,
        Request $request,
        EntityManagerInterface $em,
        FileUploaderInterface $fileUploader
    ): Response
    {
        $this->denyAccessUnlessGranted(CoasterVoter::EDIT, $coaster);
        
        //dump($coaster);
        $form = $this->createForm(CoasterType::class, $coaster);

        // Envois des données POST
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Retourne la donnée du champ "image"
            $imageFile = $form->get('image')->getData();
            if ($imageFile) {
                if ($coaster->getImageFileName()) {
                    $fileUploader->remove($coaster->getAbsoluteImageFileName());
                }

                $fileName = $fileUploader->upload($imageFile);
                $coaster->setImageFileName($fileName);
            }
            // Met à jour la base de données
            $em->flush();

            return $this->redirectToRoute('app_coaster_index');
        }
        
        return $this->render('coaster/edit.html.twig', [
            'coasterForm' => $form,
        ]);
    }

    #[Route('/coaster/{id}/delete')]
    #[IsGranted('ROLE_USER')]
    public function delete(Coaster $coaster, Request $request, EntityManagerInterface $em, FileUploaderInterface $fileUploader): Response
    {
        if ($this->isCsrfTokenValid(
            'delete'.$coaster->getId(),
            $request->request->get('_token')
        )) {
            if ($coaster->getImageFileName()) {
                $fileUploader->remove($coaster->getAbsoluteImageFileName());
            }

            $em->remove($coaster);
            $em->flush();
        
            return $this->redirectToRoute('app_coaster_index');
        }
        
        return $this->render('coaster/delete.html.twig', [
            'coaster' => $coaster,
        ]);
    }
}