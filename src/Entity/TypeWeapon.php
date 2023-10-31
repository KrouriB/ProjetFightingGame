<?php

namespace App\Entity;

use App\Repository\TypeWeaponRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TypeWeaponRepository::class)]
class TypeWeapon
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nameType = null;

    #[ORM\Column]
    private ?int $advantage = null;

    #[ORM\Column]
    private ?int $disadvantage = null;

    #[ORM\Column]
    private ?float $advantageMultiplicator = null;

    #[ORM\Column]
    private ?float $disadvantageMultiplicator = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getAdvantage(): ?int
    {
        return $this->advantage;
    }

    public function setAdvantage(int $advantage): static
    {
        $this->advantage = $advantage;

        return $this;
    }

    public function getDisadvantage(): ?int
    {
        return $this->disadvantage;
    }

    public function setDisadvantage(int $disadvantage): static
    {
        $this->disadvantage = $disadvantage;

        return $this;
    }

    public function getAdvantageMultiplicator(): ?float
    {
        return $this->advantageMultiplicator;
    }

    public function setAdvantageMultiplicator(float $advantageMultiplicator): static
    {
        $this->advantageMultiplicator = $advantageMultiplicator;

        return $this;
    }

    public function getDisadvantageMultiplicator(): ?float
    {
        return $this->disadvantageMultiplicator;
    }

    public function setDisadvantageMultiplicator(float $disadvantageMultiplicator): static
    {
        $this->disadvantageMultiplicator = $disadvantageMultiplicator;

        return $this;
    }

    public function __toString()
    {
        return $this->nameType;
    }
}
