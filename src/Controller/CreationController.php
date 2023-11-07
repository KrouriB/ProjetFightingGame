<?php

namespace App\Controller;

use App\Entity\Equipe;
use App\Entity\Weapon;
use App\Form\EquipeType;
use App\Form\WeaponType;
use App\Entity\Personnage;
use App\Form\PersonnageType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CreationController extends AbstractController
{
    #[Route('/creation/teammate', name: 'app_creation_teammate')]
    public function teammate(Request $request, EntityManagerInterface $entityManager): Response
    {
        $equipe = new Equipe();

        $form = $this->createForm(EquipeType::class, $equipe);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $equipe = $form->getData();
            $equipe->setAssosiatedUser($this->getUser());
            $entityManager->persist($equipe);
            $entityManager->flush();

            return $this->redirectToRoute('app_teammate');
        }

        return $this->render(
            'creation/teammate.html.twig',
            [
                'equipe' => $form->createView(),
            ]
        );

        // TODO: faire en sorte de d'abord selectionner un personnage et ensuite selectionne une arme et un equipement
    }

    #[Route('/creation/personnage', name: 'app_creation_personnage')]
    public function personnage(Request $request, EntityManagerInterface $entityManager): Response
    {
        $perso = new Personnage();

        $form = $this->createForm(PersonnageType::class, $perso);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $perso = $form->getData();
            $entityManager->persist($perso);
            $entityManager->flush();

            return $this->redirectToRoute('app_main',['place' => 0]);
        }

        return $this->render(
            'creation/personnage.html.twig',
            [
                'perso' => $form->createView(),
            ]
        );
    }

    #[Route('/creation/weapon', name: 'app_creation_weapon')]
    public function weapon(Request $request, EntityManagerInterface $entityManager): Response
    {
        $weapon = new Weapon();

        $form = $this->createForm(WeaponType::class, $weapon);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $weapon = $form->getData();
            $entityManager->persist($weapon);
            $entityManager->flush();

            return $this->redirectToRoute('app_main',['place' => 0]);
        }

        return $this->render(
            'creation/weapon.html.twig',
            [
                'weapon' => $form->createView(),
            ]
        );
    }
}
