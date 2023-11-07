<?php

namespace App\Controller\Admin;

use App\Entity\StockAccessory;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class StockAccessoryCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return StockAccessory::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
                ->setFormTypeOption('disabled', 'disabled'),
            AssociationField::new('stockUser'),
            AssociationField::new('accessorys')
                ->setFormTypeOptions(
                    [
                    'by_reference' => false,
                    ]
                ),
        ];
    }
}
