<?php

namespace App\Services;

use App\Entity\Equipe;
use App\Repository\ElementRepository;
use App\Repository\TypeWeaponRepository;
use App\Repository\CategoryWeaponRepository;

class JsonBuilder
{
    private ElementRepository $elementRepository;
    private TypeWeaponRepository $typeWeaponRepository;
    private CategoryWeaponRepository $categoryWeaponRepository;

    public function __construct(ElementRepository $elementRepository, TypeWeaponRepository $typeWeaponRepository, CategoryWeaponRepository $categoryWeaponRepository)
    {
        $this->elementRepository = $elementRepository;
        $this->typeWeaponRepository = $typeWeaponRepository;
        $this->categoryWeaponRepository = $categoryWeaponRepository;
    }

    public function stockData(Equipe $equipe)
    {
        $personnage = $equipe->getPersonnage();
        $weapon = $equipe->getWeapon();
        $accessory = $equipe->getAccessory();
        switch($accessory->getStatAction())
        {
            case 1:
                $action = $accessory->getTypeStatAction()->getRankStat1();
                break;
            case 2:
                $action = $accessory->getTypeStatAction()->getRankStat2();
                break;
            case 3:
                $action = $accessory->getTypeStatAction()->getRankStat3();
                break;
            case 4:
                $action = $accessory->getTypeStatAction()->getRankStat4();
                break;
        }
        $personnage = ['Element' => $personnage->getElement()->getNameElement(), 'Type' => $personnage->getType()->getNameType(), 'Category' => $personnage->getCategory()->getNameCategory(), 'Attack' => $personnage->getAttack(), 'Magic' => $personnage->getMagic(), 'Life' => $personnage->getLife(),  'Energy' => $personnage->getEnergy()];
        $weapon = ['ElementBase' => $weapon->getWeaponElement()->getNameElement(), 'ElementSkill' => $weapon->getSkillElement()->getNameElement(), 'Type' => $weapon->getWeaponType()->getNameType(), 'Category' => $weapon->getWeaponCategory()->getNameCategory(), 'baseAttack' => $weapon->getAttackStat(), 'baseMagic' => $weapon->getMagicStat(), 'skillAttack' => $weapon->getAttackSkill(), 'skillMagic' => $weapon->getMagicSkill(), 'EnergyCost' => $weapon->getEnergySkill(), 'turnWait' => $weapon->getWaitSkill(), 'skillName' => $weapon->getNameSkill()];
        $accessory = ['NomStatAction' => $accessory->getTypeStatAction()->getNomStat(), 'NomTypeAction' => $accessory->getTypeStatAction()->getNomType(), 'StatAction' => $action, 'Defense' => $accessory->getDefense(), 'Resistance' => $accessory->getResistance(), 'Attack' => $accessory->getBonusAttack(), 'Magic' => $accessory->getBonusMagic(), 'Recovery' => $accessory->getEnergyRecovery(), 'turnWait' => $accessory->getWaitAction(), 'EnergyCost' => $accessory->getEnergyAction()];
        $data = ['personnage' => $personnage, 'weapon' => $weapon, 'accessory' => $accessory];
        // for personnage we send life & energy data here too because of accessory action that can be dependent from this stat

        $jsonFile = json_encode($data);

        // dd($jsonFile);

        return $jsonFile;
    }

    public function elementData()
    {
        $elements = $this->elementRepository->findAll();

        $data = [];

        foreach($elements as $element)
        {
            $data[] = ['id' => $element->getId(), 'name' => $element->getNameElement(), 'advantage' => $element->getAdvantage(), 'advantageMultiplicator' => $element->getAdvantageMultiplicator(), 'disadvantage' => $element->getDisadvantage(), 'disadvantageMultiplicator' => $element->getDisadvantageMultiplicator()];
        }
        
        $jsonFile = json_encode($data);

        return $jsonFile;
    }

    public function typeData()
    {
        $types = $this->typeWeaponRepository->findAll();

        $data = [];

        foreach($types as $type)
        {
            $data[] = ['id' => $type->getId(), 'name' => $type->getNameType(), 'advantage' => $type->getAdvantage(), 'advantageMultiplicator' => $type->getAdvantageMultiplicator(), 'disadvantage' => $type->getDisadvantage(), 'disadvantageMultiplicator' => $type->getDisadvantageMultiplicator()];
        }
        
        $jsonFile = json_encode($data);

        return $jsonFile;
    }

    public function categoryData()
    {
        $categorys = $this->categoryWeaponRepository->findAll();

        $data = [];

        foreach($categorys as $category)
        {
            $data[] = ['id' => $category->getId(), 'name' => $category->getNameCategory(), 'advantage' => $category->getAdvantage(), 'advantageMultiplicator' => $category->getAdvantageMultiplicator(), 'disadvantage' => $category->getDisadvantage(), 'disadvantageMultiplicator' => $category->getDisadvantageMultiplicator()];
        }
        
        $jsonFile = json_encode($data);

        return $jsonFile;
    }
}