<?php

namespace App\Controller;

use App\Repository\UserRepository;
use App\Form\TeammateSelectionType;
use App\Repository\EquipeRepository;
use App\Repository\WeaponRepository;
use App\Repository\AccessoryRepository;
use App\Repository\PersonnageRepository;
use App\Repository\StockWeaponRepository;
use App\Repository\StockAccessoryRepository;
use App\Repository\StockPersonnageRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

class MenuController extends AbstractController
{
    
    #[Route('/menu/stock/personnage', name: 'app_stock_personnage')]
    public function stockPersonnage(StockPersonnageRepository $personnageRepository): Response
    {
        $personnages = $personnageRepository->findPersonnagesOfUser($this->getUser()->getId());
        // dd($personnages);
        return $this->render('menu/stock/personnage.html.twig', [
            'personnages' => $personnages,
        ]);
    }

    #[Route('/menu/stock/weapon', name: 'app_stock_weapon')]
    public function stockWeapon(StockWeaponRepository $weaponRepository): Response
    {
        $weapons = $weaponRepository->findWeaponsOfUser($this->getUser()->getId());
        // dd($weapons);
        return $this->render('menu/stock/weapon.html.twig', [
            'weapons' => $weapons,
        ]);
    }

    #[Route('/menu/stock/accessory', name: 'app_stock_accessory')]
    public function stockAccessory(StockAccessoryRepository $accessoryRepository): Response
    {
        $accessorys = $accessoryRepository->findAccessorysOfUser($this->getUser()->getId());
        return $this->render('menu/stock/accessory.html.twig', [
            'accessorys' => $accessorys,
        ]);
    }

    #[Route('/menu/rank', name: 'app_rank')]
    public function rank(UserRepository $userRepository): Response
    {
        $users = $userRepository->findBy(['id' => 'DESC']);
        return $this->render('menu/rank.html.twig', [
            'users' => $users,
        ]);
    }

    #[Route('/menu/teammate', name: 'app_teammate')]
    #[IsGranted('ROLE_USER')]
    public function teammate(EquipeRepository $equipeRepository): Response
    {
        $equipes = $equipeRepository->findBy(['assosiatedUser' => $this->getUser()->getId()]);
        return $this->render('menu/teammate.html.twig', [
            'equipes' => $equipes,
        ]);
    }
    
    #[Route('/menu/main', name: 'app_main')]
    #[IsGranted('ROLE_USER')]
    public function main(Request $request, EquipeRepository $equipeRepository): Response
    {
        $session = $request->getSession();
        
        $equipes = $equipeRepository->findBy(['assosiatedUser' => $this->getUser()->getId()]);
        // $equipePlace = $request->get('place');
        // $equipeSelect = $equipes[$equipePlace];
        // $persoSelect = $equipeSelect->getPersonnage();

        $form = $this->createForm(TeammateSelectionType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            // dd($data);
            $selectedTeammate = $data['equipe'];
            $session->set('selected_teammate', $selectedTeammate);

            return $this->redirectToRoute('app_fight');
        }

        return $this->render('menu/main.html.twig', [
            'equipes' => $equipes,
            'teammate' => $form->createView(),
        ]);
    }

    #[Route('/menu/notCo', name: 'app_not_co')]
    public function mainUnConnected(): Response
    {
        return $this->render('menu/notCo.html.twig');
    }
}
