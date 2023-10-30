<?php

namespace App\Controller\Admin;

use App\Entity\CategoryWeapon;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CategoryWeaponCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return CategoryWeapon::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
                ->setFormTypeOption('disabled', 'disabled'),
            ChoiceField::new('nameCategory')
                ->renderExpanded()
                ->setLabel('Nom Catégorie')
                ->setChoices([
                    'Classique' => 'Classique',
                    'Magie' => 'Magie',
                    'Alternatif' => 'Alternatif',
                ]),
            ChoiceField::new('advantage')
                ->renderExpanded()
                ->setLabel('Avantage')
                ->setChoices([
                    'Classique' => 1,
                    'Magie' => 2,
                    'Alternatif' => 3,
                ]),
            NumberField::new('advantageMultiplicator')
                ->setLabel("Multiplicateur a l'Avantage"),
            ChoiceField::new('disadvantage')
                ->renderExpanded()
                ->setLabel('Désavantage')
                ->setChoices([
                    'Classique' => 1,
                    'Magie' => 2,
                    'Alternatif' => 3,
                ]),
            NumberField::new('disadvantageMultiplicator')
                ->setLabel('Multiplicateur au Désavantage'),

        ];
    }
}
