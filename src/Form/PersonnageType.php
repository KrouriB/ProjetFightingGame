<?php

namespace App\Form;

use App\Entity\Element;
use App\Entity\Personnage;
use App\Entity\TypeWeapon;
use App\Entity\CategoryWeapon;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class PersonnageType extends AbstractType
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
                'life',
                IntegerType::class,
                [
                    'attr' => [
                        'class' => 'disabled centered',
                        'min' => 200,
                        'max' => 500,
                        'step' => 25,
                        'value' => 200
                    ],
                    'label' => "Point de Vie : ",
                    'help' => "Min : 200, Max : 500, 1pt = 25 PV",
                ]
            )
            ->add(
                'attack',
                IntegerType::class,
                [
                    'attr' => [
                        'class' => 'disabled centered',
                        'min' => 0,
                        'max' => 40,
                        'step' => 4,
                        'value' => 0
                    ],
                    'label' => "Attaque : ",
                    'help' => "Min : 0, Max : 40, 1pt = 4 Atk",
                ]
            )
            ->add(
                'magic',
                IntegerType::class,
                [
                    'attr' => [
                        'class' => 'disabled centered',
                        'min' => 0,
                        'max' => 40,
                        'step' => 4,
                        'value' => 0
                    ],
                    'label' => "Magie : ",
                    'help' => "Min : 0, Max : 40, 1pt = 4 Mag",
                ]
            )
            ->add(
                'energy',
                IntegerType::class,
                [
                    'attr' => [
                        'class' => 'disabled centered',
                        'min' => 60,
                        'max' => 180,
                        'step' => 8,
                        'value' => 60
                    ],
                    'label' => "Energie : ",
                    'help' => "Min : 60, Max : 180, 1pt = 8 Energie",
                ]
            )
            ->add(
                'element',
                EntityType::class,
                [
                    'class' => Element::class,
                    'query_builder' => function (EntityRepository $er): QueryBuilder {
                        return $er->createQueryBuilder('e')
                        ->where('e.id < 6')
                        ->orderBy('e.id', 'ASC');
                    },
                    'attr' => [
                        'class' => 'form-control'
                    ],
                    'label' => 'Element : '
                ]
            )
            ->add(
                'type',
                EntityType::class,
                [
                    'class' => TypeWeapon::class,
                    'attr' => [
                        'class' => 'form-control'
                    ]
                ]
            )
            ->add(
                'category',
                EntityType::class,
                [
                    'class' => CategoryWeapon::class,
                    'attr' => [
                        'class' => 'form-control'
                    ]
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
        // ajouter le 'readonly' => 'readonly' sur les integer et le script d'incrementation et decrementaion et modifier l'affichage sur la page
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Personnage::class,
        ]);
    }
}
