<?php

namespace App\Controller;

use App\Form\UserType;
use App\Form\NewPasswordType;
use App\Repository\WeaponRepository;
use App\Repository\AccessoryRepository;
use App\Repository\PersonnageRepository;
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

    #[Route(path: '/admin/validation', name: 'app_validate')]
    public function validate(AccessoryRepository $accessoryRepository, WeaponRepository $weaponRepository, PersonnageRepository $personnageRepository)
    {
        $accessorys = $accessoryRepository->findNotValid();
        $weapons = $weaponRepository->findNotValid();
        $personnages = $personnageRepository->findNotValid();

        return $this->render('security/validate.html.twig', [
            'accessorys' => $accessorys,
            'weapons' => $weapons,
            'personnages' => $personnages,
        ]);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

    #[Route(path: '/deleteUser', name: 'app_delete_user')]
    public function deleteCurrentUser(SessionInterface $session, EntityManagerInterface $entityManager, PersonnageRepository $personnageRepository, WeaponRepository $weaponRepository, AccessoryRepository $accessoryRepository)
    {
        $user = $this->getUser();
        $session->invalidate();
        $session->migrate(true); // crete new session to prevent session fixation attacks

        $personnages = $personnageRepository->findBy(['userCreator' => $this->getUser()->getId()]);
        $weapons = $weaponRepository->findBy(['userCreator' => $this->getUser()->getId()]);
        $accessorys = $accessoryRepository->findBy(['userCreator' => $this->getUser()->getId()]);

        foreach($personnages as $personnage)
        {
            $entityManager->remove($personnage);
        }
        foreach($weapons as $weapon)
        {
            $entityManager->remove($weapon);
        }
        foreach($accessorys as $accessory)
        {
            $entityManager->remove($accessory);
        }

        $entityManager->remove($user);
        $entityManager->flush();

        return $this->redirectToRoute('app_not_co');
    }

    #[Route(path: '/delete/personnage/{id}', name: 'app_delete_personnage')]
    public function deletePersonnage(EntityManagerInterface $entityManager, PersonnageRepository $personnageRepository)
    {
        $entityManager->remove($personnage);
        $entityManager->flush();
    }

    #[Route(path: '/delete/weapon/{id}', name: 'app_delete_weapon')]
    public function deleteWeapon(EntityManagerInterface $entityManager, WeaponRepository $weaponRepository)
    {
        $entityManager->remove($weapon);
        $entityManager->flush();
    }

    #[Route(path: '/delete/accessory/{id}', name: 'app_delete_accessory')]
    public function deleteAccessory(EntityManagerInterface $entityManager, AccessoryRepository $accessoryRepository)
    {
        $entityManager->remove($accessory);
        $entityManager->flush();
    }

    #[Route(path: '/validate/personnage/{id}', name: 'app_validate_personnage')]
    public function validatePersonnage(EntityManagerInterface $entityManager, PersonnageRepository $personnageRepository)
    {
        $personnage->setUserCreator(null);
        $entityManager->flush();
    }

    #[Route(path: '/validate/weapon/{id}', name: 'app_validate_weapon')]
    public function validateWeapon(EntityManagerInterface $entityManager, WeaponRepository $weaponRepository)
    {
        $weapon->setUserCreator(null);
        $entityManager->flush();
    }

    #[Route(path: '/validate/accessory/{id}', name: 'app_validate_accessory')]
    public function validateAccessory(EntityManagerInterface $entityManager, AccessoryRepository $accessoryRepository)
    {
        $accessory->setUserCreator(null);
        $entityManager->flush();
    }
}
