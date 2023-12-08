<?php

namespace App\Controller;

use App\Services\CreateRandom;
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
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

class MenuController extends AbstractController
{
    #[Route('/menu/stock/personnage', name: 'app_stock_personnage')]
    public function stockPersonnage(StockPersonnageRepository $personnageRepository/*, Request $request, RouterInterface $router*/): Response
    {
        // $session = $request->getSession();
        // if($session->get('in fight') == 'yes')
        // {
        //     return new RedirectResponse($router->generate('app_lose')); // if user was in fight when refresh/quit -> lose
        // }

        $personnages = $personnageRepository->findPersonnagesOfUser($this->getUser()->getId());
        // dd($personnages);
        return $this->render('menu/stock/personnage.html.twig', [
            'personnages' => $personnages,
        ]);
    }

    #[Route('/menu/stock/weapon', name: 'app_stock_weapon')]
    public function stockWeapon(StockWeaponRepository $weaponRepository/*, Request $request, RouterInterface $router*/): Response
    {
        // $session = $request->getSession();
        // if($session->get('in fight') == 'yes')
        // {
        //     return new RedirectResponse($router->generate('app_lose')); // if user was in fight when refresh/quit -> lose
        // }

        $weapons = $weaponRepository->findWeaponsOfUser($this->getUser()->getId());
        // dd($weapons);
        return $this->render('menu/stock/weapon.html.twig', [
            'weapons' => $weapons,
        ]);
    }

    #[Route('/menu/stock/accessory', name: 'app_stock_accessory')]
    public function stockAccessory(StockAccessoryRepository $accessoryRepository/*, Request $request, RouterInterface $router*/): Response
    {
        // $session = $request->getSession();
        // if($session->get('in fight') == 'yes')
        // {
        //     return new RedirectResponse($router->generate('app_lose')); // if user was in fight when refresh/quit -> lose
        // }
        
        $accessorys = $accessoryRepository->findAccessorysOfUser($this->getUser()->getId());
        return $this->render('menu/stock/accessory.html.twig', [
            'accessorys' => $accessorys,
        ]);
    }

    #[Route('/menu/rank', name: 'app_rank')]
    public function rank(UserRepository $userRepository/*, Request $request, RouterInterface $router*/): Response
    {
        // $session = $request->getSession();
        // if($session->get('in fight') == 'yes')
        // {
        //     return new RedirectResponse($router->generate('app_lose')); // if user was in fight when refresh/quit -> lose
        // }
        
        $users = $userRepository->findBy([],['winCount' => 'DESC']);
        return $this->render('everyone/rank.html.twig', [
            'users' => $users,
        ]);
    }

    #[Route('/menu/rule', name: 'app_rule')]
    public function rule(/*, Request $request, RouterInterface $router*/): Response
    {
        // $session = $request->getSession();
        // if($session->get('in fight') == 'yes')
        // {
        //     return new RedirectResponse($router->generate('app_lose')); // if user was in fight when refresh/quit -> lose
        // }
        
        return $this->render('everyone/rule.html.twig');
    }

    #[Route('/menu/teammate', name: 'app_teammate')]
    #[IsGranted('ROLE_USER')]
    public function teammate(EquipeRepository $equipeRepository/*, Request $request, RouterInterface $router*/): Response
    {
        // $session = $request->getSession();
        // if($session->get('in fight') == 'yes')
        // {
        //     return new RedirectResponse($router->generate('app_lose')); // if user was in fight when refresh/quit -> lose
        // }
        
        $equipes = $equipeRepository->findBy(['assosiatedUser' => $this->getUser()->getId()]);
        return $this->render('menu/teammate.html.twig', [
            'equipes' => $equipes,
        ]);
    }
    
    #[Route('/menu/main', name: 'app_main')]
    #[IsGranted('ROLE_USER')]
    public function main(Request $request/*, RouterInterface $router*/, EquipeRepository $equipeRepository): Response
    {
        // $session = $request->getSession();
        // if($session->get('in fight') == 'yes')
        // {
        //     return new RedirectResponse($router->generate('app_lose')); // if user was in fight when refresh/quit -> lose
        // }
        
        $session = $request->getSession();
        
        $equipes = $equipeRepository->findBy(['assosiatedUser' => $this->getUser()->getId()]);

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
    public function mainUnConnected(CreateRandom $createRandom, PersonnageRepository $personnageRepository): Response
    {
        $personnages = $personnageRepository->findBy(['userCreator' => null]);
        $personnage = $personnages[$createRandom->createSingleRandom(count($personnages))];

        return $this->render('menu/notCo.html.twig', [
            'personnage' => $personnage
        ]);
    }

    #[Route('/', name: 'app_redirect_menu')]
    public function redirectMenu(/*Request $request, RouterInterface $router*/): Response
    {
        if($this->getUser() == true)
        {
        //     $session = $request->getSession();
        // if($session->get('in fight') == 'yes')
        // {
        //     return new RedirectResponse($router->generate('app_lose')); // if user was in fight when refresh/quit -> lose
        // }
            return $this->redirectToRoute('app_main');
        }
        else
        {
            return $this->redirectToRoute('app_not_co');
        }
    }
}
