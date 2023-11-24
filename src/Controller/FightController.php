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
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FightController extends AbstractController
{
    #[Route('/fight/lose', name: 'app_lose')]
    public function lose(Request $request): Response
    {
        $request->getSession()->set('in fight', 'no');

        $this->getUser()->loseGame();

        return $this->redirectToRoute('app_main');
    }
    
    #[Route('/fight/win', name: 'app_win')]
    public function win(Request $request): Response
    {
        $request->getSession()->set('in fight', 'no');

        // ici test si la vie du personnage adverse et inferieur egale a 0

        $this->getUser()->winGame();

        return $this->redirectToRoute('app_main');
    }

    #[Route('/fight', name: 'app_fight')]
    public function fight(
        Request $request,
        CreateRandom $createRandom,
        JsonBuilder $jsonBuilder,
        CheckFight $check,
        PersonnageRepository $personnageRepository,
        WeaponRepository $weaponRepository,
        AccessoryRepository $accessoryRepository,
        EquipeRepository $equipeRepository,
    ): Response
    {
        $session = $request->getSession();
        $mate = $session->get('selected_teammate'); // here we retive the object Equipe selectioned by the user where all the value except the id are null
        if($mate == 'none' || $mate = null) // here test if the user is coming from the menu or if he have refreshed the fight
        {
            $check->checkIfInFight();
            
            return $this->redirectToRoute('app_main');
        }
        $session->set('selected_teammate', 'none'); // here set selectedTeammate to 'none' so you cannot access to the fighting scene out of the menu ans cannot refresh the fight
        $session->set('in fight', 'yes');

        
        $ally = $equipeRepository->find($mate->getId()); // with the id of the precedent Object Equipe we find the same object with all the correct value


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
