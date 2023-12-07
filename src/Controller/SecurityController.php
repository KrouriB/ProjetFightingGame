<?php

namespace App\Controller;

use App\Form\UserType;
use App\Form\NewPasswordType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\PasswordHasher\Hasher\PasswordHasherFactoryInterface;

class SecurityController extends AbstractController
{
    #[Route(path: '/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        if ($this->getUser() == true) {
            return $this->redirectToRoute('app_redirect_menu');
        }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    #[Route(path: '/user', name: 'app_user')]
    public function user(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager, UserInterface $userInterface): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $enteredPassword = $form->get('password')->getData();
            if (!$userPasswordHasher->isPasswordValid($userInterface, $enteredPassword))
            {
                $this->addFlash('error', 'Mot de passe invalde.');

                return $this->redirectToRoute('app_user');
            }

            $this->addFlash('success', 'Les information on été modifier.');

            $entityManager->flush();
        }

        return $this->render('security/user.html.twig', [
            'userInfo' => $form->createView(),
        ]);
    }

    #[Route(path: '/password', name: 'app_password')]
    public function newPassword(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager, UserInterface $userInterface)
    {
        $user = $this->getUser();
        $form = $this->createForm(NewPasswordType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $enteredPassword = $form->get('passwordConfirm')->getData();
            if (!$userPasswordHasher->isPasswordValid($userInterface, $enteredPassword))
            {
                $this->addFlash('error', 'Mot de passe invalde.');

                return $this->redirectToRoute('app_user');
            }

            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );
            
            $entityManager->flush();
            
            $this->addFlash('success', 'Le mot de passe a été modifier.');

            return $this->redirectToRoute('app_user');
        }

        return $this->render('security/password.html.twig', [
            'userInfo' => $form->createView(),
        ]);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

    #[Route(path: '/deleteUser', name: 'app_delete_user')]
    public function deleteCurrentUser(SessionInterface $session, EntityManagerInterface $entityManager)
    {
        $user = $this->getUser();
        $session->invalidate();
        $session->migrate(true); // crete new session to prevent session fixation attacks
        $entityManager->remove($user);
        $entityManager->flush();

        return $this->redirectToRoute('app_not_co');
    }


}
