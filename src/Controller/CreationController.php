<?php

namespace App\Controller;

use App\Entity\Equipe;
use App\Entity\Weapon;
use App\Form\EquipeType;
use App\Form\WeaponType;
use App\Entity\Accessory;
use App\Entity\Personnage;
use App\Form\AccessoryType;
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
        // TODO: selection equipement selon min de vie et limite sur le type et categorie d'arme
    }

    #[Route('/creation/personnage', name: 'app_creation_personnage')]
    public function personnage(Request $request, EntityManagerInterface $entityManager): Response
    {
        $perso = new Personnage();

        $form = $this->createForm(PersonnageType::class, $perso);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $perso = $form->getData();
            switch($perso->getCategory())
            {
                case 1:
                    switch($perso->getType())
                    {
                        case 1:
                            $perso->setImagePath('/img/character/axesman.png');
                            break;
                        case 2:
                            $perso->setImagePath('/img/character/swordsman.png');
                            break;
                        case 3:
                            $perso->setImagePath('/img/character/spearsman.png');
                            break;
                    }
                case 2:
                    switch($perso->getType())
                    {
                        case 1:
                            $perso->setImagePath('/img/character/mage_tattou_midJourney_modified.png');
                            break;
                        case 2:
                            $perso->setImagePath('/img/character/mage_book_midjourney_modified.png');
                            break;
                        case 3:
                            $perso->setImagePath('/img/character/mageWand.png');
                            break;
                    }
                case 3:
                    switch($perso->getType())
                    {
                        case 1:
                            $perso->setImagePath('/img/character/fighter.png');
                            break;
                        case 2:
                            $perso->setImagePath('/img/character/thief.png');
                            break;
                        case 3:
                            $perso->setImagePath('/img/character/ranger.png');
                            break;
                    }
            }

            // test si les valeurs envoyer ont été modifier en trichant
            if($perso->getAttack() % 4 != 0)
            {
                return $this->redirectToRoute('app_creation_personnage');
            }
            elseif($perso->getMagic() % 4 != 0)
            {
                return $this->redirectToRoute('app_creation_personnage');
            }
            elseif(($perso->getEnergy() - 60) % 8 != 0)
            {
                return $this->redirectToRoute('app_creation_personnage');
            }
            elseif(($perso->getLife() - 200) % 25 != 0)
            {
                return $this->redirectToRoute('app_creation_personnage');
            }
            elseif((($perso->getMagic() / 4) + ($perso->getAttack() / 4) + (($perso->getEnergy() - 60) / 8) + (($perso->getLife() - 200) / 25)) > 31)
            {
                return $this->redirectToRoute('app_creation_personnage');
            }
            elseif($this->getUser()->getGold() < 2000)
            {
                return $this->redirectToRoute('app_creation_personnage');
            }
            
            $perso->setUserCreator($this->getUser());

            $this->getUser()->createPersonnage();

            $entityManager->persist($perso);
            $entityManager->persist($this->getUser());
            $entityManager->flush();

            return $this->redirectToRoute('app_main');
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

            return $this->redirectToRoute('app_main');
        }

        return $this->render(
            'creation/weapon.html.twig',
            [
                'weapon' => $form->createView(),
            ]
        );
    }

    #[Route('/creation/accessory', name: 'app_creation_accessory')]
    public function accessory(Request $request, EntityManagerInterface $entityManager): Response
    {
        $accessory = new Accessory();

        $form = $this->createForm(AccessoryType::class, $accessory);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $accessory = $form->getData();
            $accessory->setEnergyAction($accessory->getEnergyAction() * $accessory->getStatAction()); // set the accessory energy * by the rank action selectionned
            $accessory->setWaitAction($accessory->getWaitAction() * $accessory->getStatAction());
            $entityManager->persist($accessory);
            $entityManager->flush();

            return $this->redirectToRoute('app_main');
        }

        return $this->render(
            'creation/accessory.html.twig',
            [
                'accessory' => $form->createView(),
            ]
        );
        // TODO: faire en sorte que le rank affiche le pourcentage selon le type d'action selectionner
    }
}
