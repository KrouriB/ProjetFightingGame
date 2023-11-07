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
                IntegerType::class
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
                        'min' => 20,
                        'max' => 200,
                        'step' => 1,
                        'value' => 20
                    ]
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
                        'step' => 1,
                        'value' => 20
                    ]
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
                        'min' => 50,
                        'max' => 500,
                        'step' => 1,
                        'value' => 50
                    ]
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
                        'step' => 1,
                        'value' => 50
                    ]
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
                    ]
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
                    ]
                ]
            )
            ->add(
                'valider',
                SubmitType::class,
                [
                    'attr' => [
                        'class' => 'btn btn-success'
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
