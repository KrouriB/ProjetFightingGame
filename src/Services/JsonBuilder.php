<?php

namespace App\Services;

use App\Entity\Equipe;

class JsonBuilder
{
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
        $data = [];
        $data['personnage'] = ['Element' => $personnage->getElement()->getNameElement(), 'Type' => $personnage->getType()->getNameType(), 'Category' => $personnage->getCategory()->getNameCategory(), 'Attack' => $personnage->getAttack(), 'Magic' => $personnage->getMagic(), 'Life' => $personnage->getLife(),  'Energy' => $personnage->getEnergy()];
        $data['weapon'] = ['ElementBase' => $weapon->getWeaponElement()->getNameElement(), 'ElementSkill' => $weapon->getSkillElement()->getNameElement(), 'Type' => $weapon->getWeaponType()->getNameType(), 'Category' => $weapon->getWeaponCategory()->getNameCategory(), 'baseAttack' => $weapon->getAttackStat(), 'baseMagic' => $weapon->getMagicStat(), 'skillAttack' => $weapon->getAttackSkill(), 'skillMagic' => $weapon->getMagicSkill(), 'EnergyCost' => $weapon->getEnergySkill(), 'turnWait' => $weapon->getWaitSkill(), 'skillName' => $weapon->getNameSkill()];
        $data['accessory'] = ['NomStatAction' => $accessory->getTypeStatAction()->getNomStat(), 'NomTypeAction' => $accessory->getTypeStatAction()->getNomType(), 'StatAction' => $action, 'Defense' => $accessory->getDefense(), 'Resistance' => $accessory->getResistance(), 'Attack' => $accessory->getBonusAttack(), 'Magic' => $accessory->getBonusMagic(), 'Recovery' => $accessory->getEnergyRecovery(), 'turnWait' => $accessory->getWaitAction()];
        // for personnage we send life & energy data here too because of accessory action that can be dependent from this stat

        $jsonFile = json_encode($data);

        // dd($jsonFile);

        return $jsonFile;
    }
}