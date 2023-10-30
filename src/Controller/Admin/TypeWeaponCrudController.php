<?php

namespace App\Controller\Admin;

use App\Entity\TypeWeapon;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class TypeWeaponCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return TypeWeapon::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
                ->setFormTypeOption('disabled','disabled'),
            ChoiceField::new('nameType')
                ->renderExpanded()
                ->setLabel('Les différent type')
                ->setChoices([
                    'Type 1 : Hache, Gantelet, Magie à main nue' => 'Type 1',
                    'Type 2 : épée, Dague, Tome Magique' => 'Type 2',
                    'Type 3 : Lance, Arc, Sceptre' => 'Type 3',
                ]),
            ChoiceField::new('advantage')
                ->renderExpanded()
                ->setLabel('Avantage')
                ->setChoices([
                    'Type 1 : Hache, Gantelet, Magie à main nue' => 1,
                    'Type 2 : épée, Dague, Tome Magique' => 2,
                    'Type 3 : Lance, Arc, Sceptre' => 3,
                ]),
            NumberField::new('advantageMultiplicator')
                ->setLabel("Multiplicateur a l'Avantage"),
            ChoiceField::new('disadvantage')
                ->renderExpanded()
                ->setLabel('Désavantage')
                ->setChoices([
                    'Type 1 : Hache, Gantelet, Magie à main nue' => 1,
                    'Type 2 : épée, Dague, Tome Magique' => 2,
                    'Type 3 : Lance, Arc, Sceptre' => 3,
                ]),
            NumberField::new('disadvantageMultiplicator')
                ->setLabel('Multiplicateur au Désavantage'),

        ];
    }
}
