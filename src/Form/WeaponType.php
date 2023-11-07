<?php

namespace App\Form;

use App\Entity\Weapon;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class WeaponType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('attackStat')
            ->add('magicStat')
            ->add('attackSkill')
            ->add('magicSkill')
            ->add('energySkill')
            ->add('waitSkill')
            ->add('cost')
            ->add('nameSkill')
            ->add('weaponType')
            ->add('weaponCategory')
            ->add('weaponElement')
            ->add('skillElement')
            ->add('stockWeapons')
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
