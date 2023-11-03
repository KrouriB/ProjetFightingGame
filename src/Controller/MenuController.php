<?php

namespace App\Controller;

use App\Repository\EquipeRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class MenuController extends AbstractController
{
    #[Route('/menu/rank', name: 'app_rank')]
    public function rank(UserRepository $userRepository): Response
    {
        $users = $userRepository->findBy(['winCount' => 'DESC']);
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
    
    #[Route('/menu/main/{place}', name: 'app_main')]
    #[IsGranted('ROLE_USER')]
    public function main(Request $request, EquipeRepository $equipeRepository): Response
    {
        $equipes = $equipeRepository->findBy(['assosiatedUser' => $this->getUser()->getId()]);
        $equipePlace = $request->get('place');
        $equipeSelect = $equipes[$equipePlace];
        $persoSelect = $equipeSelect->getPersonnage();
        return $this->render('menu/main.html.twig', [
            'equipes' => $equipes,
            'selected' => $equipeSelect
        ]);
    }

    #[Route('/menu/notCo', name: 'app_not_co')]
    public function mainUnConnected(): Response
    {
        return $this->render('menu/notCo.html.twig');
    }
}
