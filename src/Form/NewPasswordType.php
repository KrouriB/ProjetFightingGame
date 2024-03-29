<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class NewPasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('passwordConfirm', PasswordType::class, [
            'mapped' => false, // This field is not mapped to the entity
        ])
        ->add('plainPassword', RepeatedType::class, [
            'type' => PasswordType::class,
            'invalid_message' => 'The password fields must match.',
            'mapped' => false,
            'options' => ['attr' => ['class' => 'inputRegiLogi', 'autocomplete' => 'new-password']],
            'required' => true,
            'constraints' => [
                new NotBlank([
                    'message' => 'Please enter a password',
                ]),
                new Regex([
                    'pattern' => "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?! @$%^&* -]).{12,}$/",
                    'message' => 'Le mot de passe doit avoir une longueur de 12 caractères, 1 Majuscule, 1 Miniscule, 1 Chiffre et 1 Caractère spécial',
                ]),
            ],
            'first_options'  => ['label' => 'Mot de Passe : '],
            'second_options' => ['label' => 'Répéter le : '],
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
