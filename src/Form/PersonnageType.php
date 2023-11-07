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
                        'class' => 'form-control',
                        'min' => 200,
                        'max' => 500,
                        'step' => 20,
                    ]
                ]
            )
            ->add(
                'attack',
                IntegerType::class,
                [
                    'attr' => [
                        'class' => 'form-control',
                        'min' => 0,
                        'max' => 40,
                        'step' => 4
                    ]
                ]
            )
            ->add(
                'magic',
                IntegerType::class,
                [
                    'attr' => [
                        'class' => 'form-control',
                        'min' => 0,
                        'max' => 40,
                        'step' => 4
                    ]
                ]
            )
            ->add(
                'energy',
                IntegerType::class,
                [
                    'attr' => [
                        'class' => 'form-control',
                        'min' => 60,
                        'max' => 180,
                        'step' => 6
                    ]
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
                    ]
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
