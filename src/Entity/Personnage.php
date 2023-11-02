<?php

namespace App\Entity;

use App\Entity\TypeWeapon;
use App\Entity\CategoryWeapon;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\PersonnageRepository;

#[ORM\Entity(repositoryClass: PersonnageRepository::class)]
class Personnage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $attack = null;

    #[ORM\Column]
    private ?int $magic = null;

    #[ORM\Column]
    private ?int $energy = null;

    #[ORM\Column]
    private ?int $life = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Element $element = null;

    #[ORM\ManyToOne]
    private ?TypeWeapon $type = null;

    #[ORM\ManyToOne]
    private ?CategoryWeapon $category = null;

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

    public function getAttack(): ?int
    {
        return $this->attack;
    }

    public function setAttack(int $attack): static
    {
        $this->attack = $attack;

        return $this;
    }

    public function getMagic(): ?int
    {
        return $this->magic;
    }

    public function setMagic(int $magic): static
    {
        $this->magic = $magic;

        return $this;
    }

    public function getEnergy(): ?int
    {
        return $this->energy;
    }

    public function setEnergy(int $energy): static
    {
        $this->energy = $energy;

        return $this;
    }

    public function getLife(): ?int
    {
        return $this->life;
    }

    public function setLife(int $life): static
    {
        $this->life = $life;

        return $this;
    }

    public function getElement(): ?Element
    {
        return $this->element;
    }

    public function setElement(?Element $element): static
    {
        $this->element = $element;

        return $this;
    }

    public function getType(): ?TypeWeapon
    {
        return $this->type;
    }

    public function setType(?TypeWeapon $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getCategory(): ?CategoryWeapon
    {
        return $this->category;
    }

    public function setCategory(?CategoryWeapon $category): static
    {
        $this->category = $category;

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }
}
