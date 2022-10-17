<?php

namespace App\Controller;


use App\Form\ModifierProfilType;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
//use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UtilisateurController extends AbstractController
{
    #[Route('/espace_membre/utilisateur', name: 'app_utlisateur')]
    public function index(): Response
    {
        return $this->render('utilisateur/index.html.twig', [
            'controller_name' => 'UtilisateurController',
        ]);
    }

    #[Route('/espace_membre/profile', name: 'profile_edit')]
    public function edit(

        Request                     $request,
        EntityManagerInterface      $entityManager,
       // UserPasswordEncoderInterface $passwordEncoder,

    ): Response
    {
        $user =$this->getUser();
        $form = $this->createForm(ModifierProfilType::class , $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
        //    $user->setPassword($passwordEncoder->encodePassword($user, $user->getPassword()));
            $entityManager->persist($user);
            $entityManager->flush();
            $this->addFlash('message' , 'profil mis à jour');
            return $this->redirect($this->generateUrl('profile_edit'));
        }
        //
        return $this->render('utilisateur/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
