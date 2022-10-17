<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Form\ModifierProfilType;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
//use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UtlisateurController extends AbstractController
{
    #[Route('/espace_membre/utilisateur', name: 'app_utlisateur')]
    public function index(): Response
    {
        return $this->render('utlisateur/index.html.twig', [
            'controller_name' => 'UtlisateurController',
        ]);
    }

    #[Route('/espace_membre/profile', name: 'profile_edit')]
    public function edit(

        Request                $request,
        EntityManagerInterface $entityManager,
        UserPasswordHasherInterface $userPasswordHasher,

    ): Response
    {
        $user =$this->getUser();
        $form = $this->createForm(ModifierProfilType::class , $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );
            $entityManager->persist($user);
            $entityManager->flush();
            $this->addFlash('message' , 'profil mis à jour');
            return $this->redirect($this->generateUrl('profile_edit'));
        }
        //
        return $this->render('utlisateur/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
