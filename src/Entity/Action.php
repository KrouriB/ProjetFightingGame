<?php

namespace App\Entity;

use App\Repository\ActionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ActionRepository::class)]
class Action
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 30)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $energyAction = null;

    #[ORM\Column]
    private ?int $waitAction = null;

    #[ORM\Column]
    private ?int $statAction = null; // en pourcentge

    #[ORM\Column(length: 50)]
    private ?string $nameStat = null;

    #[ORM\Column(length: 30)]
    private ?string $nameType = null;

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

    public function getEnergyAction(): ?int
    {
        return $this->energyAction;
    }

    public function setEnergyAction(int $energyAction): static
    {
        $this->energyAction = $energyAction;

        return $this;
    }

    public function getWaitAction(): ?int
    {
        return $this->waitAction;
    }

    public function setWaitAction(int $waitAction): static
    {
        $this->waitAction = $waitAction;

        return $this;
    }

    public function getStatAction(): ?int
    {
        return $this->statAction;
    }

    public function setStatAction(int $statAction): static
    {
        $this->statAction = $statAction;

        return $this;
    }

    public function getNameStat(): ?string
    {
        return $this->nameStat;
    }

    public function setNameStat(string $nameStat): static
    {
        $this->nameStat = $nameStat;

        return $this;
    }

    public function getNameType(): ?string
    {
        return $this->nameType;
    }

    public function setNameType(string $nameType): static
    {
        $this->nameType = $nameType;

        return $this;
    }
}
