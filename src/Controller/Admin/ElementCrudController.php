<?php

namespace App\Controller\Admin;

use App\Entity\Element;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ElementCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Element::class;
    }

    

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
                ->setFormTypeOption('disabled','disabled'),
            ChoiceField::new('nameElement')
                ->renderExpanded()
                ->setLabel('Les différent Éléments')
                ->setChoices([
                    'Feu' => 'Feu',
                    'Terre' => 'Terre',
                    'Métal' => 'Métal',
                    'Eau' => 'Eau',
                    'Bois' => 'Bois',
                ]),
            ChoiceField::new('advantage')
                ->renderExpanded()
                ->setLabel('Avantage')
                ->setChoices([
                    'Feu' => 1,
                    'Terre' => 2,
                    'Métal' => 3,
                    'Eau' => 4,
                    'Bois' => 5,
                ]),
            NumberField::new('advantageMultiplicator')
                ->setLabel("Multiplicateur a l'Avantage"),
            ChoiceField::new('disadvantage')
                ->renderExpanded()
                ->setLabel('Désavantage')
                ->setChoices([
                    'Feu' => 1,
                    'Terre' => 2,
                    'Métal' => 3,
                    'Eau' => 4,
                    'Bois' => 5,
                ]),
            NumberField::new('disadvantageMultiplicator')
                ->setLabel('Multiplicateur au Désavantage'),

        ];
    }
}
