<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Form\RegistrationFormType;
use App\Form\RegistrationUtilisateurFormType;
use App\Repository\UtilisateurRepository;
use App\Security\EmailVerifier;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mime\Address;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;

class RegistrationController extends AbstractController
{
    private EmailVerifier $emailVerifier;

    public function __construct(EmailVerifier $emailVerifier)
    {
        $this->emailVerifier = $emailVerifier;
    }

    #[Route('/admin/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
        $user = new Utilisateur();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Default values
            $user->setIsCguAccepte(false);
            // encode the plain password
            //By default provisional password is generated randomly
            try {
                $user->setPassword(
                    $userPasswordHasher->hashPassword(
                        $user,
                        random_bytes(16)
                    )
                );
            } catch (\Exception $e) {
                return $this->render('registration/register.html.twig', [
                    'registrationForm' => $form->createView(),
                ]);
            }

            $entityManager->persist($user);
            $entityManager->flush();

            // generate a signed url and email it to the user
            $this->emailVerifier->sendEmailConfirmation('app_verify_email', $user,
                (new TemplatedEmail())
                    ->from(new Address('no-reply@sortirdotcom.com', 'SortirDotCom'))
                    ->to($user->getCourriel())
                    ->subject('Confirmation courriel')
                    ->htmlTemplate('registration/confirmation_email.html.twig')
            );
            // do anything else you need here, like send an email

            return $this->redirectToRoute('app_login');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

    #[Route('/verify/email', name: 'app_verify_email')]
    public function verifyUserEmail(Request $request, UtilisateurRepository $utilisateurRepository): Response
    {
        // Forbidden for connected users
        if(null !== $this->getUser()) {
            $this->addFlash('warning', 'Vous auriez dû être déconnecté pour accéder à cette page.');
            return $this->redirectToRoute('app_accueil');
        }

        $id = $request->get('id'); // retrieve the user id from the url
               // Verify the user id exists and is not null
        if (null === $id) {
            return $this->redirectToRoute('app_accueil');
        }

        $user = $utilisateurRepository->find($id);

        // Ensure the user exists in persistence
        if (null === $user) {
            return $this->redirectToRoute('app_accueil');
        }

        // Ensure the user has not already
        if ($user->isIsCguAccepte()) {
            // Si l'utilisateur a déjà validé les conditions d'utilisation
            // alors cela signifie qu'il ne doit pas accéder à ce formulaire
            // donc :
            return $this->redirectToRoute('app_accueil');
        }

        // validate email confirmation link, sets User::isVerified=true and persists
        try {
            $this->emailVerifier->handleEmailConfirmation($request, $user);
        } catch (VerifyEmailExceptionInterface $exception) {
            $this->addFlash('verify_email_error', $exception->getReason());
            return $this->redirectToRoute('app_register_utilisateur_expire');
        }
        $this->addFlash('success', 'Votre courriel a bien été vérifié.');

        //$request->getSession()->set("id_nouveau_utilisateur", $user->getId());
        $this->addFlash("id_nouveau_utilisateur", $user->getId());
        $form = $this->createForm(RegistrationUtilisateurFormType::class, $user);

        return $this->render('registration/register_utilisateur.html.twig', [
            'registrationUtilisateurForm' => $form->createView()
        ]);
    }

    #[Route('/register', name: 'app_register_utilisateur')]
    public function registerUtilisateur(
        Request $request,
        UserPasswordHasherInterface $userPasswordHasher,
        EntityManagerInterface $entityManager,
        UtilisateurRepository $utilisateurRepository
    ): Response
    {
        // Forbidden for connected users
        if(null !== $this->getUser()) {
            return $this->redirectToRoute('app_accueil');
        }

        $user_id = $request->getSession()->get('id_nouveau_utilisateur');
        $users = $utilisateurRepository->findBy(['id' => $user_id]);
        if (empty($users) || $users[0]->isIsCguAccepte()) {
            // Si l'utilisateur a déjà validé les conditions d'utilisation
            // alors cela signifie qu'il ne doit pas accéder à ce formulaire
            // donc :
            return $this->redirectToRoute('app_accueil');
        }
        $user = $users[0];
        $form = $this->createForm(RegistrationUtilisateurFormType::class, $user);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $request->getSession()->remove('id_nouveau_utilisateur');
            // encode the plain password
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('app_login');
        }
        return $this->render('registration/register_utilisateur.html.twig', [
            'registrationUtilisateurForm' => $form->createView()
        ]);
    }

    #[Route('/register', name: 'app_register_utilisateur_expire')]
    public function registerUtilisateurExpire(): Response {
        return $this->render('registration/register_utilisateur_expire.html.twig');
    }
}
