<?php

namespace App\Controller\Admin;

use App\Entity\TypeStatAction;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class TypeStatActionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return TypeStatAction::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
                ->setFormTypeOption('disabled', 'disabled'),
            ChoiceField::new('nomStat')
                ->renderExpanded()
                ->setLabel("Stat de base de l'action")
                ->setChoices([
                    'Attaque' => 'Attack',
                    'Magie' => 'Magic',
                    'Vie' => 'Life',
                ]),
            TextField::new('nomType')
                ->setLabel("Type d'action"),
            IntegerField::new('rankStat1'),
            IntegerField::new('rankStat2'),
            IntegerField::new('rankStat3'),
            IntegerField::new('rankStat4'),
        ];
    }
}
