<?php

namespace App\Controller;

use App\Entity\Equipe;
use App\Services\CheckFight;
use App\Services\JsonBuilder;
use App\Services\CreateRandom;
use App\Repository\EquipeRepository;
use App\Repository\WeaponRepository;
use App\Repository\AccessoryRepository;
use App\Repository\PersonnageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FightController extends AbstractController
{
    #[Route('/fight/lose', name: 'app_lose')]
    public function lose(Request $request, EntityManagerInterface $entityManager): Response
    {
        // $request->getSession()->set('in fight', 'no');

        $this->getUser()->loseGame();
        // dd($this->getUser()->getWinCount());
        $entityManager->persist($this->getUser());
        $entityManager->flush();

        $this->addFlash('error', 'Perdu ! Vous allez rester sur une défaite ?');

        return $this->redirectToRoute('app_main');
    }
    
    #[Route('/fight/win', name: 'app_win')]
    public function win(Request $request, EntityManagerInterface $entityManager): Response
    {
        // $request->getSession()->set('in fight', 'no');

        // ici test si la vie du personnage adverse et inferieur egale a 0

        $this->getUser()->winGame();
        // dd($this->getUser()->getWinCount());
        $entityManager->persist($this->getUser());
        $entityManager->flush();

        $this->addFlash('success', 'Vous avez gagner la partie et reçu 500 gold !');

        return $this->redirectToRoute('app_main');
    }

    #[Route('/fight', name: 'app_fight')]
    public function fight(
        Request $request,
        RouterInterface $router,
        CreateRandom $createRandom,
        JsonBuilder $jsonBuilder,
        PersonnageRepository $personnageRepository,
        WeaponRepository $weaponRepository,
        AccessoryRepository $accessoryRepository,
        EquipeRepository $equipeRepository,
    ): Response
    {
        $session = $request->getSession();
        $mate = $session->get('selected_teammate'); // here we retive the object Equipe selectioned by the user where all the value except the id are null
        // if($mate == 'none' || $mate = null) // here test if the user is coming from the menu or if he have refreshed the fight
        // {
        //     // dd($mate->getId());
        //     if($session->get('in fight') == 'yes')
        //     {
        //         return new RedirectResponse($router->generate('app_lose')); // if user was in fight when refresh/quit -> lose
        //     }
            
        //     return $this->redirectToRoute('app_main');
        // }

        // $mate = $session->get('selected_teammate');
        $ally = $equipeRepository->find($mate->getId()); // with the id of the precedent Object Equipe we find the same object with all the correct value
        
        // $session->set('in fight', 'yes');
        // $session->set('selected_teammate', null); // here set selectedTeammate to 'none' so you cannot access to the fighting scene out of the menu ans cannot refresh the fight

        // searching a random character in the db
        $personnages = $personnageRepository->findBy(['userCreator' => null]);
        $personnage = $personnages[$createRandom->createSingleRandom(count($personnages))];
        
        // search a weapon thet the character should be able to use
        $weapons = $weaponRepository->findWeaponsAdapted($personnage);
        $weapon = $weapons[$createRandom->createSingleRandom(count($weapons))];
        
        // search an accessory thet the character should be able to use
        $accessorys = $accessoryRepository->findAccessorysAdapted($personnage);
        $accessory = $accessorys[$createRandom->createSingleRandom(count($accessorys))];
        
        // create the ennemie teammate
        $ennemie = new Equipe();
        $ennemie->setPersonnage($personnage);
        $ennemie->setWeapon($weapon);
        $ennemie->setAccessory($accessory);

        // dd($session);
        
        return $this->render('fight/index.html.twig', [
            'ally' => $ally,
            'ennemie' => $ennemie,
            'allyData' => $jsonBuilder->stockData($ally), // create JSON string to send data to js file for the fight
            'ennemieData' => $jsonBuilder->stockData($ennemie),
            'element' => $jsonBuilder->elementData(),
            'type' => $jsonBuilder->typeData(),
            'category' => $jsonBuilder->categoryData(),
        ]);
    }
}
