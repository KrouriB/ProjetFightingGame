<?php

namespace App\Controller;

use App\Entity\Equipe;
use App\Services\CreateRandom;
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
    #[Route('/fight', name: 'app_fight')]
    public function index(Request $request, CreateRandom $createRandom, PersonnageRepository $personnageRepository, WeaponRepository $weaponRepository, AccessoryRepository $accessoryRepository): Response
    {
        $session = $request->getSession();
        $teammate = $session->get('selected_teammate');

        // searching a random character in the db
        $personnages = $personnageRepository->findBy(['userCreator' => null]);
        $personnage = $personnages[$createRandom->createSingleRandom(count($personnages))];
        
        // search a weapon thet the character should be able to use
        $weapons = $weaponRepository->findWeaponsAdapted($personnage);
        $weapon = $weapons[$createRandom->createSingleRandom(count($weapons))];
        
        // search an accessory thet the character should be able to use
        $accessorys = $accessoryRepository->findAccessorysAdapted($personnage);
        $accessory = $accessorys[$createRandom->createSingleRandom(count($accessorys))];
        
        // create the enemies teammate
        $enemies = new Equipe();
        $enemies->setPersonnage($personnage);
        $enemies->setWeapon($weapon);
        $enemies->setAccessory($accessory);
        dd($enemies);
        
        return $this->render('fight/index.html.twig', [
            'teammate' => $teammate,
            'enemies' => $enemies,
        ]);
    }
}
