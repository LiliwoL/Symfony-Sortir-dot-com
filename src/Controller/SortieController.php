<?php

namespace App\Controller;

use App\Entity\Site;
use App\Entity\Sortie;
use App\Form\RechercheSortieType;
use App\Form\SortieType;
use App\Repository\SortieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/espace_membre/sortie')]
class SortieController extends AbstractController
{
    #[Route('/', name: 'app_sortie_index', methods: ['GET', 'POST'])]
    public function index(Request $request, SortieRepository $sortieRepository): Response
    {
        $form = $this->createForm(RechercheSortieType::class);
        $form->handleRequest($request);

        // Calcul de l'état de la sortie
        $dateCourante= new \DateTime();
        foreach ($sortieRepository->findAll() as $sortie){
            $sortie->etat='NON VALIDE';
            if ( $sortie->getDateEnregistrement() <= $dateCourante){ $sortie->etat = 'EN CREATION'; }
            if ( $sortie->getDateOuvertureInscription() <= $dateCourante){ $sortie->etat = 'OUVERT'; }
            if ( $sortie->getDateFermetureInscription() <= $dateCourante){ $sortie->etat = 'FERME'; }
            if ( $sortie->getDateDebutSortie() <= $dateCourante){ $sortie->etat = 'EN COURS'; }
            if ( $sortie->getDateFinSortie() <= $dateCourante){ $sortie->etat = 'ARCHIVE'; }
        }

        if ($form->isSubmitted() && $form->isValid()) {
            $choicesRequest = $form->getData();
            $choices['site'] = $choicesRequest['site'] ?? "";
            $choices['mot_cle'] = $choicesRequest['mot_cle'] ?? "";
            $choices['date_debut'] = $choicesRequest['date_debut'] ?? "";
            $choices['date_fin'] = $choicesRequest['date_fin'] ?? "";
            $choices['organisateur'] = $choicesRequest['organisateur'] ?? false;
            $choices['inscrit'] = $choicesRequest['inscrit'] ?? false;
            $choices['passe'] = $choicesRequest['passe'] ?? false;
            $choices['user_id'] = $this->getUser();
            $sorties = $sortieRepository->searchSortie($choices);
        } else {
            $sorties = $sortieRepository->findAll();
        }

        return $this->render('sortie/index.html.twig', [
            'sorties' => $sorties,
            'form' => $form->createView()
        ]);
    }

    #[Route('/new', name: 'app_sortie_new', methods: ['GET', 'POST'])]
    public function new(Request $request, SortieRepository $sortieRepository): Response
    {
        $sortie = new Sortie();
        $form = $this->createForm(SortieType::class, $sortie);
        $form->handleRequest($request);



        if ($form->isSubmitted() && $form->isValid()) {

            $sortieRepository->save($sortie, true);
            return $this->redirectToRoute('app_sortie_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('sortie/new.html.twig', [
            'sortie' => $sortie,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_sortie_show', methods: ['GET'])]
    public function show(Sortie $sortie): Response
    {
        $dateCourante= new \DateTime();
        $sortie->etat='NON VALIDE';

        if ( $sortie->getDateEnregistrement() <= $dateCourante){ $sortie->etat = 'EN CREATION'; }
        if ( $sortie->getDateOuvertureInscription() <= $dateCourante){ $sortie->etat = 'OUVERT'; }
        if ( $sortie->getDateFermetureInscription() <= $dateCourante){ $sortie->etat = 'FERME'; }
        if ( $sortie->getDateDebutSortie() <= $dateCourante){ $sortie->etat = 'EN COURS'; }
        if ( $sortie->getDateFinSortie() <= $dateCourante){ $sortie->etat = 'ARCHIVE'; }

        return $this->render('sortie/show.html.twig', [
            'sortie' => $sortie,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_sortie_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Sortie $sortie, SortieRepository $sortieRepository): Response
    {
        $form = $this->createForm(SortieType::class, $sortie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $sortieRepository->save($sortie, true);

            return $this->redirectToRoute('app_sortie_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('sortie/edit.html.twig', [
            'sortie' => $sortie,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_sortie_delete', methods: ['POST'])]
    public function delete(Request $request, Sortie $sortie, SortieRepository $sortieRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$sortie->getId(), $request->request->get('_token'))) {
            $sortieRepository->remove($sortie, true);
        }

        return $this->redirectToRoute('app_sortie_index', [], Response::HTTP_SEE_OTHER);
    }



}
