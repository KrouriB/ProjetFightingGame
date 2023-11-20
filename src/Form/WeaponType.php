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
                    ]
                ]
            )
            ->add(
                'cost',
                IntegerType::class,
                [
                    'attr' => [
                        'class' => 'hidden'
                    ]
                ]
            )
            ->add(
                'weaponType',
                EntityType::class,
                [
                    'class' => TypeWeapon::class,
                    'attr' => [
                        'class' => 'form-control'
                    ]
                ]
            )
            ->add(
                'weaponCategory',
                EntityType::class,
                [
                    'class' => CategoryWeapon::class,
                    'attr' => [
                        'class' => 'form-control'
                    ]
                ]
            )
            ->add(
                'weaponElement',
                EntityType::class,
                [
                    'class' => Element::class,
                    'attr' => [
                        'class' => 'form-control'
                    ]
                ]
            )
            ->add(
                'attackStat',
                IntegerType::class,
                [
                    'attr' => [
                        'class' => 'form-control',
                        'min' => 200,
                        'max' => 2000,
                        'step' => 10,
                        'value' => 200
                    ],
                    'label' => "Atk. Base : ",
                    'help' => "Min : 20%, Max : 2000%, 5 or = 1%",
                ]
            )
            ->add(
                'magicStat',
                IntegerType::class,
                [
                    'attr' => [
                        'class' => 'form-control',
                        'min' => 200,
                        'max' => 2000,
                        'step' => 10,
                        'value' => 200
                    ],
                    'label' => "Mag. Base : ",
                    'help' => "Min : 200%, Max : 2000%, 5 or = 10%",
                ]
            )
            ->add(
                'nameSkill',
                TextType::class,
                [
                    'attr' => [
                        'class' => 'form-control'
                    ]
                ]
            )
            ->add(
                'skillElement',
                EntityType::class,
                [
                    'class' => Element::class,
                    'attr' => [
                        'class' => 'form-control'
                    ]
                ]
            )
            ->add(
                'attackSkill',
                IntegerType::class,
                [
                    'attr' => [
                        'class' => 'form-control',
                        'min' => 500,
                        'max' => 5000,
                        'step' => 10,
                        'value' => 500
                    ],
                    'label' => "Atk. Comp. : ",
                    'help' => "Min : 500%, Max : 5000%, 15 or = 10%",
                ]
            )
            ->add(
                'magicSkill',
                IntegerType::class,
                [
                    'attr' => [
                        'class' => 'form-control',
                        'min' => 500,
                        'max' => 5000,
                        'step' => 10,
                        'value' => 500
                    ],
                    'label' => "Mag. Comp. : ",
                    'help' => "Min : 500%, Max : 5000%, 15 or = 10%",
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
                        'step' => 1,
                        'value' => 30
                    ],
                    'label' => "Nrj. Comp. : ",
                    'help' => "Min : 30, Max : 180, - 15 or = + 1 Nrj",
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
                    'label' => "Tours Attente : ",
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
