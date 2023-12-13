<?php

namespace App\Form;

use App\Entity\Weapon;
use App\Entity\Element;
use App\Entity\TypeWeapon;
use App\Entity\CategoryWeapon;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class WeaponType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'name',
                TextType::class,
                [
                    'attr' => [
                        'class' => 'form-control'
                    ],
                    'label' => "Nom : ",
                ]
            )
            ->add(
                'weaponType',
                EntityType::class,
                [
                    'class' => TypeWeapon::class,
                    'attr' => [
                        'class' => 'form-control'
                    ],
                    'label' => "Type : ",
                ]
            )
            ->add(
                'weaponCategory',
                EntityType::class,
                [
                    'class' => CategoryWeapon::class,
                    'attr' => [
                        'class' => 'form-control'
                    ],
                    'label' => "Catégorie : ",
                ]
            )
            ->add(
                'weaponElement',
                EntityType::class,
                [
                    'class' => Element::class,
                    'attr' => [
                        'class' => 'form-control'
                    ],
                    'label' => "Element de base : ",
                ]
            )
            ->add(
                'attackStat',
                IntegerType::class,
                [
                    'attr' => [
                        'class' => 'form-control',
                        'min' => 20,
                        'max' => 200,
                        'step' => 10,
                        'value' => 20,
                    ],
                    'label' => "Attaque Base : ",
                    'help' => "Min : 20%, Max : 200%, 50 or = 10%",
                ]
            )
            ->add(
                'magicStat',
                IntegerType::class,
                [
                    'attr' => [
                        'class' => 'form-control',
                        'min' => 20,
                        'max' => 200,
                        'step' => 10,
                        'value' => 20,
                    ],
                    'label' => "Magie Base : ",
                    'help' => "Min : 20%, Max : 200%, 50 or = 10%",
                ]
            )
            ->add(
                'nameSkill',
                TextType::class,
                [
                    'attr' => [
                        'class' => 'form-control'
                    ],
                    'label' => "Nom de Compétence: ",
                ]
            )
            ->add(
                'skillElement',
                EntityType::class,
                [
                    'class' => Element::class,
                    'attr' => [
                        'class' => 'form-control'
                    ],
                    'label' => "Element de compétence : ",
                ]
            )
            ->add(
                'attackSkill',
                IntegerType::class,
                [
                    'attr' => [
                        'class' => 'form-control',
                        'min' => 50,
                        'max' => 500,
                        'step' => 10,
                        'value' => 50
                    ],
                    'label' => "Attaque Compétence : ",
                    'help' => "Min : 50%, Max : 500%, 150 or = 10%",
                ]
            )
            ->add(
                'magicSkill',
                IntegerType::class,
                [
                    'attr' => [
                        'class' => 'form-control',
                        'min' => 50,
                        'max' => 500,
                        'step' => 10,
                        'value' => 50
                    ],
                    'label' => "Magie Compétence : ",
                    'help' => "Min : 50%, Max : 500%, 150 or = 10%",
                ]
            )
            ->add(
                'energySkill',
                IntegerType::class,
                [
                    'attr' => [
                        'class' => 'form-control',
                        'min' => 30,
                        'max' => 180,
                        'step' => 6,
                        'value' => 30
                    ],
                    'label' => "Energie Compétence : ",
                    'help' => "Min : 30, Max : 180, - 90 or = + 6 Nrj",
                ]
            )
            ->add(
                'waitSkill',
                IntegerType::class,
                [
                    'attr' => [
                        'class' => 'form-control',
                        'min' => 1,
                        'max' => 10,
                        'step' => 1,
                        'value' => 1
                    ],
                    'label' => "Tours d'Attente : ",
                    'help' => "Min : 1, Max : 10, - 150 or = + 1 Tour",
                ]
            )
            ->add(
                'valider',
                SubmitType::class,
                [
                    'attr' => [
                        'class' => 'hidden'
                    ]
                ]
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Weapon::class,
        ]);
    }
}
