<?php

namespace App\Controller\Admin;

use App\Entity\StockPersonnage;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class StockPersonnageCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return StockPersonnage::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
                ->setFormTypeOption('disabled', 'disabled'),
            AssociationField::new('stockUser'),
            AssociationField::new('personnages')
                ->setFormTypeOptions(
                    [
                    'by_reference' => false,
                    ]
                )
                ->renderAsNativeWidget(),
        ];
    }
}
