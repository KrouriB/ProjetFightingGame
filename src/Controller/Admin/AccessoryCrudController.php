<?php

namespace App\Controller\Admin;

use App\Entity\Accessory;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class AccessoryCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Accessory::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
                ->setFormTypeOption('disabled', 'disabled'),
            TextField::new('name'),
            IntegerField::new('cost'),
            IntegerField::new('minLife'),
            IntegerField::new('defense'),
            IntegerField::new('resistance'),
            IntegerField::new('bonusAttack'),
            IntegerField::new('bonusMagic'),
            IntegerField::new('energyRecovery'),
            TextField::new('nameAction'),
            AssociationField::new('typeStatAction'),
            IntegerField::new('energyAction'),
            IntegerField::new('waitAction'),
            ChoiceField::new('statAction')
                ->renderExpanded()
                ->setLabel('Rang de la competance')
                ->setChoices([
                    'Rank 1' => 1,
                    'Rank 2' => 2,
                    'Rank 3' => 3,
                    'Rank 4' => 4,
                ]),
        ];
    }
}
