<?php

namespace App\Controller\Admin;

use App\Entity\Element;
use App\Entity\Personnage;
use App\Repository\ElementRepository;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Config\KeyValueStore;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class PersonnageCrudController extends AbstractCrudController
{
    private ElementRepository $elementRepository;

    public function __construct(ElementRepository $elementRepository)
    {
        $this->elementRepository = $elementRepository;
    }

    public static function getEntityFqcn(): string
    {
        return Personnage::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
                ->setFormTypeOption('disabled', 'disabled'),
            TextField::new('name'),
            IntegerField::new('life'),
            IntegerField::new('attack'),
            IntegerField::new('magic'),
            IntegerField::new('energy'),
            IntegerField::new('magic'),
            AssociationField::new('element')
                ->setLabel('Éléments du personnage')
                ->setFormTypeOption('query_builder', function (ElementRepository $elementRepository) {
                    return $elementRepository->createQueryBuilder('e')
                        ->where('e.id < 6')
                        ->orderBy('e.id', 'ASC');
                }),
            AssociationField::new('category'),
            AssociationField::new('type'),
        ];
    }

    

    public function configureCrud(Crud $crud): Crud
    {
        return $crud;
    }
}
