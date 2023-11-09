<?php

namespace App\Form;

use App\Entity\Accessory;
use App\Entity\TypeStatAction;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class AccessoryType extends AbstractType
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
                'minLife',
                IntegerType::class,
                [
                    'attr' => [
                        'class' => 'form-control',
                        'min' => 200,
                        'max' => 500,
                        'step' => 100,
                        'value' => 200
                    ]
                ]
            )
            ->add(
                'defense',
                IntegerType::class,
                [
                    'attr' => [
                        'class' => 'form-control',
                        'min' => 0,
                        'max' => 20,
                        'step' => 2,
                        'value' => 0
                    ]
                ]
            )
            ->add(
                'resistance',
                IntegerType::class,
                [
                    'attr' => [
                        'class' => 'form-control',
                        'min' => 0,
                        'max' => 20,
                        'step' => 2,
                        'value' => 0
                    ]
                ]
            )
            ->add(
                'bonusAttack',
                IntegerType::class,
                [
                    'attr' => [
                        'class' => 'form-control',
                        'min' => 0,
                        'max' => 10,
                        'step' => 1,
                        'value' => 0
                    ]
                ]
            )
            ->add(
                'bonusMagic',
                IntegerType::class,
                [
                    'attr' => [
                        'class' => 'form-control',
                        'min' => 0,
                        'max' => 10,
                        'step' => 1,
                        'value' => 0
                    ]
                ]
            )
            ->add(
                'energyRecovery',
                IntegerType::class,
                [
                    'attr' => [
                        'class' => 'form-control',
                        'min' => 0,
                        'max' => 90,
                        'step' => 18,
                        'value' => 0
                    ]
                ]
            )
            ->add(
                'nameAction',
                TextType::class,
                [
                    'attr' => [
                        'class' => 'form-control'
                    ]
                ]
            )
            ->add(
                'typeStatAction',
                EntityType::class,
                [
                    'class' => TypeStatAction::class,
                    'attr' => [
                        'class' => 'form-control'
                    ]
                ]
            )
            ->add(
                'energyAction',
                IntegerType::class,
                [
                    'attr' => [
                        'class' => 'form-control',
                        'min' => 15,
                        'max' => 45,
                        'step' => 3,
                        'value' => 15
                    ]
                ]
            )
            ->add(
                'waitAction',
                IntegerType::class,
                [
                    'attr' => [
                        'class' => 'form-control',
                        'min' => 1,
                        'max' => 3,
                        'step' => 1,
                        'value' => 1
                    ]
                ]
            )
            ->add(
                'statAction',
                ChoiceType::class,
                [
                    'choices'  => [
                        '1' => 1,
                        '2' => 2,
                        '3' => 3,
                        '4' => 4,
                    ],
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
            'data_class' => Accessory::class,
        ]);
    }
}
