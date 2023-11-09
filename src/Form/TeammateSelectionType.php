<?php

namespace App\Form;

use App\Entity\Equipe;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class TeammateSelectionType extends AbstractType
{
    private Security $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add(
            'equipe',
            EntityType::class,
            [
                'class' => Equipe::class,
                'query_builder' => function (EntityRepository $er): QueryBuilder {
                    return $er->createQueryBuilder('e')
                        ->InnerJoin('e.assosiatedUser', 'u')
                        ->andWhere('u.id = :id')
                        ->setParameter('id', $this->security->getUser()->getId());
                },
                'choice_label' => 'team_name',
                'attr' => [
                    'class' => 'form-control'
                ]
            ]
        )
        ->add(
            'Start',
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
            'data_class' => null, // Allow for non-entity form
        ]);
    }
}
