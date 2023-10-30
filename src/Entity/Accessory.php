<?php

namespace App\Entity;

use App\Repository\AccessoryRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AccessoryRepository::class)]
class Accessory
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $minLife = null;

    #[ORM\Column]
    private ?int $defense = null;

    #[ORM\Column]
    private ?int $resistance = null;

    #[ORM\Column]
    private ?int $bonusAttack = null;

    #[ORM\Column]
    private ?int $bonusMagic = null;

    #[ORM\Column]
    private ?int $energyRecovery = null;

    #[ORM\Column]
    private ?int $cost = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getMinLife(): ?int
    {
        return $this->minLife;
    }

    public function setMinLife(int $minLife): static
    {
        $this->minLife = $minLife;

        return $this;
    }

    public function getDefense(): ?int
    {
        return $this->defense;
    }

    public function setDefense(int $defense): static
    {
        $this->defense = $defense;

        return $this;
    }

    public function getResistance(): ?int
    {
        return $this->resistance;
    }

    public function setResistance(int $resistance): static
    {
        $this->resistance = $resistance;

        return $this;
    }

    public function getBonusAttack(): ?int
    {
        return $this->bonusAttack;
    }

    public function setBonusAttack(int $bonusAttack): static
    {
        $this->bonusAttack = $bonusAttack;

        return $this;
    }

    public function getBonusMagic(): ?int
    {
        return $this->bonusMagic;
    }

    public function setBonusMagic(int $bonusMagic): static
    {
        $this->bonusMagic = $bonusMagic;

        return $this;
    }

    public function getEnergyRecovery(): ?int
    {
        return $this->energyRecovery;
    }

    public function setEnergyRecovery(int $energyRecovery): static
    {
        $this->energyRecovery = $energyRecovery;

        return $this;
    }

    public function getCost(): ?int
    {
        return $this->cost;
    }

    public function setCost(int $cost): static
    {
        $this->cost = $cost;

        return $this;
    }
}
