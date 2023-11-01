<?php

namespace App\Controller\Admin;

use App\Entity\Weapon;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class WeaponCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Weapon::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
                ->setFormTypeOption('disabled', 'disabled'),
            TextField::new('name'),
            AssociationField::new('weaponCategory'),
            AssociationField::new('weaponType'),
            IntegerField::new('attackStat'),
            IntegerField::new('magicStat'),
            AssociationField::new('weaponElement'),
            TextField::new('nameSkill'),
            IntegerField::new('attackSkill'),
            IntegerField::new('magicSkill'),
            IntegerField::new('energySkill'),
            IntegerField::new('waitSkill'),
            AssociationField::new('skillElement'),
            IntegerField::new('cost'),
        ];
    }
}
