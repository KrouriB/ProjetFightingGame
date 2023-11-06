<?php

namespace App\Form;

use App\Entity\Equipe;
use App\Entity\Weapon;
use App\Entity\Accessory;
use App\Entity\Personnage;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class EquipeType extends AbstractType
{
    private Security $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        // dd($this->security->getUser());
        $builder
            ->add(
                'teamName',
                TextType::class,
                [
                    'attr' => [
                        'class' => 'form-control'
                    ]
                ]
            )
            ->add(
                'personnage',
                EntityType::class,
                [
                    'class' => Personnage::class,
                    'query_builder' => function (EntityRepository $er): QueryBuilder {
                        return $er->createQueryBuilder('p')
                            ->InnerJoin('p.stockPersonnages', 'sp')
                            ->InnerJoin('sp.stockUser', 'u')
                            ->andWhere('u.id = :id')
                            ->setParameter('id', $this->security->getUser()->getId());
                    },
                    'choice_label' => 'name',
                    'attr' => [
                        'class' => 'form-control'
                    ]
                ]
            )
            ->add(
                'weapon',
                EntityType::class,
                [
                    'class' => Weapon::class,
                    'query_builder' => function (EntityRepository $er): QueryBuilder {
                        return $er->createQueryBuilder('w')
                            ->InnerJoin('w.stockWeapons', 'sw')
                            ->InnerJoin('sw.stockUser', 'u')
                            ->andWhere('u.id = :id')
                            ->setParameter('id', $this->security->getUser()->getId());
                    },
                    'choice_label' => 'name',
                    'attr' => [
                        'class' => 'form-control'
                    ]
                ]
            )
            ->add(
                'accessory',
                EntityType::class,
                [
                    'class' => Accessory::class,
                    'query_builder' => function (EntityRepository $er): QueryBuilder {
                        return $er->createQueryBuilder('a')
                            ->InnerJoin('a.stockAccessorys','sa')
                            ->InnerJoin('sa.stockUser', 'u')
                            ->andWhere('u.id = :id')
                            ->setParameter('id', $this->security->getUser()->getId());
                    },
                    'choice_label' => 'name',
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
                        'class' => 'btn btn-success'
                    ]
                ]
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Equipe::class,
        ]);
    }
}
