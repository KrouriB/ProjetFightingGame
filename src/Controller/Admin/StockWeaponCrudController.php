<?php

namespace App\Controller\Admin;

use App\Entity\StockWeapon;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class StockWeaponCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return StockWeapon::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
                ->setFormTypeOption('disabled', 'disabled'),
            AssociationField::new('stockUser'),
            AssociationField::new('weapons')
                ->setFormTypeOptions(
                    [
                    'by_reference' => false,
                    ]
                ),
        ];
    }
}
