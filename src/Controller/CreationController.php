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
            
            $this->addFlash('success', 'Vous avez créer votre équipier !');

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
            switch($perso->getCategory()->getId())
            {
                case 1:
                    switch($perso->getType()->getId())
                    {
                        case 1:
                            $perso->setImagePath('/img/character/axesman.webp');
                            break;
                        case 2:
                            $perso->setImagePath('/img/character/swordsman.webp');
                            break;
                        case 3:
                            $perso->setImagePath('/img/character/spearsman.webp');
                            break;
                    }
                    break;
                case 2:
                    switch($perso->getType()->getId())
                    {
                        case 1:
                            $perso->setImagePath('/img/character/mage_tattou_midJourney_modified.webp');
                            break;
                        case 2:
                            $perso->setImagePath('/img/character/mage_book_midjourney_modified.webp');
                            break;
                        case 3:
                            $perso->setImagePath('/img/character/mageWand.webp');
                            break;
                    }
                    break;
                case 3:
                    switch($perso->getType()->getId())
                    {
                        case 1:
                            $perso->setImagePath('/img/character/fighter.webp');
                            break;
                        case 2:
                            $perso->setImagePath('/img/character/thief.webp');
                            break;
                        case 3:
                            $perso->setImagePath('/img/character/ranger.webp');
                            break;
                    }
                    break;
            }

            // test si les valeurs envoyer ont été modifier en trichant
            if($perso->getAttack() % 4 != 0)
            {
                $this->addFlash('error', 'Votre Personnage a des valeur non valide');
                return $this->redirectToRoute('app_creation_personnage');
            }
            elseif($perso->getMagic() % 4 != 0)
            {
                $this->addFlash('error', 'Votre Personnage a des valeur non valide');
                return $this->redirectToRoute('app_creation_personnage');
            }
            elseif(($perso->getEnergy() - 60) % 8 != 0)
            {
                $this->addFlash('error', 'Votre Personnage a des valeur non valide');
                return $this->redirectToRoute('app_creation_personnage');
            }
            elseif(($perso->getLife() - 200) % 25 != 0)
            {
                $this->addFlash('error', 'Votre Personnage a des valeur non valide');
                return $this->redirectToRoute('app_creation_personnage');
            }
            elseif((($perso->getMagic() / 4) + ($perso->getAttack() / 4) + (($perso->getEnergy() - 60) / 8) + (($perso->getLife() - 200) / 25)) > 31)
            {
                $this->addFlash('error', 'Votre Personnage a des valeur non valide');
                return $this->redirectToRoute('app_creation_personnage');
            }
            elseif($this->getUser()->getGold() < 2000)
            {
                $this->addFlash('error', 'Vous n\'avez pas assez d\'argent pour faire ce personnage, il vous en faut 2000');
                return $this->redirectToRoute('app_creation_personnage');
            }
            
            $perso->setUserCreator($this->getUser());

            $this->getUser()->createPersonnage();

            $stockPerso = $this->getUser()->getStockPersonnages();
            $stockPerso[0]->addPersonnage($perso);

            // dd($stockPerso);

            $entityManager->persist($perso);
            $entityManager->persist($this->getUser());
            $entityManager->persist($stockPerso[0]);
            $entityManager->flush();

            $this->addFlash('success', 'Vous avez créer votre personnage !');
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
            switch($weapon->getCategory()->getId())
            {
                case 1:
                    switch($weapon->getType()->getId())
                    {
                        case 1:
                            $weapon->setImagePath('/img/character/axe.webp');
                            break;
                        case 2:
                            $weapon->setImagePath('/img/character/sword.webp');
                            break;
                        case 3:
                            $weapon->setImagePath('/img/character/lance.webp');
                            break;
                    }
                    break;
                case 2:
                    switch($weapon->getType()->getId())
                    {
                        case 1:
                            $weapon->setImagePath('/img/character/tattou.webp');
                            break;
                        case 2:
                            $weapon->setImagePath('/img/character/book.webp');
                            break;
                        case 3:
                            $weapon->setImagePath('/img/character/wand.webp');
                            break;
                    }
                    break;
                case 3:
                    switch($weapon->getType()->getId())
                    {
                        case 1:
                            $weapon->setImagePath('/img/character/gauntlet.webp');
                            break;
                        case 2:
                            $weapon->setImagePath('/img/character/dagger.webp');
                            break;
                        case 3:
                            $weapon->setImagePath('/img/character/bow.webp');
                            break;
                    }
                    break;
            }

            $gold = (($weapon->getAttackStat() / 10) * 50) + (($weapon->getMagicStat() / 10) * 50) + (($weapon->getAttackSkill() / 10) * 150) + (($weapon->getMagicSkill() / 10) * 150) - ((($weapon->getEnergySkill() - 30) / 6) * 90) - ((($weapon->getWaitSkill() - 1) / 1) * 150);

            // test si les valeurs envoyer ont été modifier en trichant
            if(($weapon->getAttackStat() % 10 != 0) || ($weapon->getAttackStat() > 200))
            {
                $this->addFlash('error', 'Votre arme a des valeur non valide');
                return $this->redirectToRoute('app_creation_weapon');
            }
            elseif(($weapon->getMagicStat() % 10 != 0) || ($weapon->getMagicStat() > 200))
            {
                $this->addFlash('error', 'Votre arme a des valeur non valide');
                return $this->redirectToRoute('app_creation_weapon');
            }
            elseif(($weapon->getAttackSkill() % 10 != 0) || ($weapon->getAttackSkill() > 500))
            {
                $this->addFlash('error', 'Votre arme a des valeur non valide');
                return $this->redirectToRoute('app_creation_weapon');
            }
            elseif(($weapon->getMagicSkill() % 10 != 0) || ($weapon->getMagicSkill() > 500))
            {
                $this->addFlash('error', 'Votre arme a des valeur non valide');
                return $this->redirectToRoute('app_creation_weapon');
            }
            elseif((($weapon->getEnergySkill() - 30) % 6 != 0) || ($weapon->getEnergySkill() > 180) || ($weapon->getEnergySkill() < 30))
            {
                $this->addFlash('error', 'Votre arme a des valeur non valide');
                return $this->redirectToRoute('app_creation_weapon');
            }
            elseif((($weapon->getWaitSkill() - 1) % 1 != 0) || ($weapon->getWaitSkill() > 10) || ($weapon->getWaitSkill() < 1))
            {
                $this->addFlash('error', 'Votre arme a des valeur non valide');
                return $this->redirectToRoute('app_creation_weapon');
            }
            elseif($this->getUser()->getGold() < $gold)
            {
                $this->addFlash('error', 'Vous n\'avez pas assez d\'argent pour faire ce arme, il vous en faut '.$gold);
                return $this->redirectToRoute('app_creation_weapon');
            }

            $weapon->setCost($gold);
            
            $weapon->setUserCreator($this->getUser());

            $this->getUser()->createPersonnage();

            $stockWeapon = $this->getUser()->getStockWeapons();
            $stockWeapon[0]->addWeapon($weapon);

            // dd($stockWeapon);

            $entityManager->persist($weapon);
            $entityManager->persist($this->getUser());
            $entityManager->persist($stockWeapon[0]);
            $entityManager->flush();

            $this->addFlash('success', 'Vous avez créer votre arme !');
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
