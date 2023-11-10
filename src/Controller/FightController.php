<?php

namespace App\Controller;

use App\Entity\Equipe;
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
    #[Route('/fight', name: 'app_fight')]
    public function index(Request $request, CreateRandom $createRandom, PersonnageRepository $personnageRepository, WeaponRepository $weaponRepository, AccessoryRepository $accessoryRepository, EquipeRepository $equipeRepository): Response
    {
        $session = $request->getSession();
        $mate = $session->get('selected_teammate'); // here we retive the object Equipe selectioned by the user where all the value except the id are null
        $teammate = $equipeRepository->find($mate->getId()); // with the id of the precedent Object Equipe we find the same object with all the correct value

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

        
        // set in session the teammates hp and energy in session to modify them later as actual stat and not max
        $session->set('ennemie', ['hp' => $ennemie->getPersonnage()->getLife(), 'energy' => $ennemie->getPersonnage()->getEnergy()]);
        $session->set('ally', ['hp' => $teammate->getPersonnage()->getLife(), 'energy' => $teammate->getPersonnage()->getEnergy()]);
        
        // dd($session);
        
        return $this->render('fight/index.html.twig', [
            'teammate' => $teammate,
            'ennemie' => $ennemie,
        ]);
    }
}
