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
    #[Route('/menu/main/{rank}', name: 'app_main_co')]
    #[IsGranted('ROLE_USER')]
    public function main(AuthorizationCheckerInterface $authChecker, Request $request, EquipeRepository $equipeRepository): Response
    {
        $equipes = $equipeRepository->findBy(['assosiatedUser' => $this->getUser()->getId()]);
        $equipeRank = $request->get('rank');
        $equipeSelect = $equipes[$equipeRank];
        $persoSelect = $equipeSelect->getPersonnage();
        // dd($persoSelect);
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
