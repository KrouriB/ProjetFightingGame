<?php

namespace App\Controller;

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
            $entityManager->persist($equipe);
            $entityManager->flush();

            return $this->redirectToRoute('app_home');
        }

        return $this->render(
            'creation/teammate.html.twig',
            [
                'equipe' => $form->createView(),
            ]
        );
    }
}
