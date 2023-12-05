<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\StockWeapon;
use App\Services\CreateRandom;
use App\Entity\StockAccessory;
use App\Entity\StockPersonnage;
use App\Security\EmailVerifier;
use App\Form\RegistrationFormType;
use App\Security\AppAuthenticator;
use Symfony\Component\Mime\Address;
use App\Repository\WeaponRepository;
use App\Repository\AccessoryRepository;
use App\Repository\PersonnageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;

class RegistrationController extends AbstractController
{
    private EmailVerifier $emailVerifier;
    private AccessoryRepository $accessoryRepository;
    private WeaponRepository $weaponRepository;
    private PersonnageRepository $personnageRepository;
    private CreateRandom $createRandom;
    private EntityManagerInterface $entityManager;

    public function __construct(EmailVerifier $emailVerifier, AccessoryRepository $accessoryRepository, WeaponRepository $weaponRepository, PersonnageRepository $personnageRepository, CreateRandom $createRandom, EntityManagerInterface $entityManager)
    {
        $this->emailVerifier = $emailVerifier;
        $this->accessoryRepository = $accessoryRepository;
        $this->weaponRepository = $weaponRepository;
        $this->personnageRepository = $personnageRepository;
        $this->createRandom = $createRandom;
        $this->entityManager = $entityManager;
    }

    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, UserAuthenticatorInterface $userAuthenticator, AppAuthenticator $authenticator): Response
    {
        if ($this->getUser() == true) {
            return $this->redirectToRoute('app_main');
        }
        
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $stockAccessory = $this->createStockAccessory();
            $stockWeapon = $this->createStockWeapon();
            $stockPersonnage = $this->createStockPersonnage();

            $user->addStockPersonnage($stockPersonnage);
            $user->addStockWeapon($stockWeapon);
            $user->addStockAccessory($stockAccessory);

            $this->entityManager->persist($user);
            $this->entityManager->flush();

            
            
            // generate a signed url and email it to the user
            $this->emailVerifier->sendEmailConfirmation('app_verify_email', $user,
                (new TemplatedEmail())
                    ->from(new Address('verification.mail@fighting-adventure.fr', 'VerifBot'))
                    ->to($user->getEmail())
                    ->subject('Please Confirm your Email')
                    ->htmlTemplate('registration/confirmation_email.html.twig')
            );
            // do anything else you need here, like send an email

            // return $userAuthenticator->authenticateUser(
            //     $user,
            //     $authenticator,
            //     $request
            // );
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

    #[Route('/verify/email', name: 'app_verify_email')]
    public function verifyUserEmail(Request $request, TranslatorInterface $translator): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        // validate email confirmation link, sets User::isVerified=true and persists
        try {
            $this->emailVerifier->handleEmailConfirmation($request, $this->getUser());
        } catch (VerifyEmailExceptionInterface $exception) {
            $this->addFlash('verify_email_error', $translator->trans($exception->getReason(), [], 'VerifyEmailBundle'));

            return $this->redirectToRoute('app_register');
        }

        // @TODO Change the redirect on success and handle or remove the flash message in your templates
        $this->addFlash('success', 'Your email address has been verified.');

        return $this->redirectToRoute('app_register');
    }

    #[Route('/agreeTerms', name: 'app_agreeTerms')]
    public function agreeTerms()
    {
        return $this->render('terms.html.twig');
    }

    public function createStockPersonnage()
    {
        $personnages = $this->personnageRepository->findFirstPersonnages();
        $randomFive = $this->createRandom->createFiveRandom();
        $stockP = new StockPersonnage();
        foreach($randomFive as $random)
        {
            $stockP->addPersonnage($personnages[$random]);
        }

        $this->entityManager->persist($stockP);
        $this->entityManager->flush();

        return $stockP;
    }

    public function createStockAccessory()
    {
        $accessorys = $this->accessoryRepository->findFirstAccessory();
        $stockA = new StockAccessory();
        foreach($accessorys as $accessory)
        {
            $stockA->addAccessory($accessory);
        }

        $this->entityManager->persist($stockA);
        $this->entityManager->flush();

        return $stockA;
    }

    public function createStockWeapon()
    {
        $weapons = $this->weaponRepository->findFirstWeapons();
        $stockW = new StockWeapon();
        foreach($weapons as $weapon)
        {
            $stockW->addWeapon($weapon);
        }

        $this->entityManager->persist($stockW);
        $this->entityManager->flush();
        
        return $stockW;
    }
}
