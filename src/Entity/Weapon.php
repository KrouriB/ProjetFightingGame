<?php

namespace App\Entity;

use App\Repository\WeaponRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WeaponRepository::class)]
class Weapon
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $attackStat = null;

    #[ORM\Column]
    private ?int $magicStat = null;

    #[ORM\Column]
    private ?int $attackSkill = null;

    #[ORM\Column]
    private ?int $magicSkill = null;

    #[ORM\Column]
    private ?int $energySkill = null;

    #[ORM\Column]
    private ?int $waitSkill = null;

    #[ORM\Column]
    private ?int $cost = null;

    #[ORM\Column(length: 30)]
    private ?string $nameSkill = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?TypeWeapon $weaponType = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?CategoryWeapon $weaponCategory = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Element $weaponElement = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Element $skillElement = null;

    #[ORM\ManyToMany(targetEntity: StockWeapon::class, mappedBy: 'weapons')]
    private Collection $stockWeapons;

    #[ORM\ManyToOne]
    private ?User $userCreator = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $imagePath = null;

    public function __construct()
    {
        $this->stockWeapons = new ArrayCollection();
    }

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

    public function getAttackStat(): ?int
    {
        return $this->attackStat;
    }

    public function setAttackStat(int $attackStat): static
    {
        $this->attackStat = $attackStat;

        return $this;
    }

    public function getMagicStat(): ?int
    {
        return $this->magicStat;
    }

    public function setMagicStat(int $magicStat): static
    {
        $this->magicStat = $magicStat;

        return $this;
    }

    public function getAttackSkill(): ?int
    {
        return $this->attackSkill;
    }

    public function setAttackSkill(int $attackSkill): static
    {
        $this->attackSkill = $attackSkill;

        return $this;
    }

    public function getMagicSkill(): ?int
    {
        return $this->magicSkill;
    }

    public function setMagicSkill(int $magicSkill): static
    {
        $this->magicSkill = $magicSkill;

        return $this;
    }

    public function getEnergySkill(): ?int
    {
        return $this->energySkill;
    }

    public function setEnergySkill(int $energySkill): static
    {
        $this->energySkill = $energySkill;

        return $this;
    }

    public function getWaitSkill(): ?int
    {
        return $this->waitSkill;
    }

    public function setWaitSkill(int $waitSkill): static
    {
        $this->waitSkill = $waitSkill;

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

    public function getNameSkill(): ?string
    {
        return $this->nameSkill;
    }

    public function setNameSkill(string $nameSkill): static
    {
        $this->nameSkill = $nameSkill;

        return $this;
    }

    public function getWeaponType(): ?TypeWeapon
    {
        return $this->weaponType;
    }

    public function setWeaponType(?TypeWeapon $weaponType): static
    {
        $this->weaponType = $weaponType;

        return $this;
    }

    public function getWeaponCategory(): ?CategoryWeapon
    {
        return $this->weaponCategory;
    }

    public function setWeaponCategory(?CategoryWeapon $weaponCategory): static
    {
        $this->weaponCategory = $weaponCategory;

        return $this;
    }

    public function getWeaponElement(): ?Element
    {
        return $this->weaponElement;
    }

    public function setWeaponElement(?Element $weaponElement): static
    {
        $this->weaponElement = $weaponElement;

        return $this;
    }

    public function getSkillElement(): ?Element
    {
        return $this->skillElement;
    }

    public function setSkillElement(?Element $skillElement): static
    {
        $this->skillElement = $skillElement;

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }

    /**
     * @return Collection<int, StockWeapon>
     */
    public function getStockWeapons(): Collection
    {
        return $this->stockWeapons;
    }

    public function addStockWeapon(StockWeapon $stockWeapon): static
    {
        if (!$this->stockWeapons->contains($stockWeapon)) {
            $this->stockWeapons->add($stockWeapon);
            $stockWeapon->addWeapon($this);
        }

        return $this;
    }

    public function removeStockWeapon(StockWeapon $stockWeapon): static
    {
        if ($this->stockWeapons->removeElement($stockWeapon)) {
            $stockWeapon->removeWeapon($this);
        }

        return $this;
    }

    public function getUserCreator(): ?User
    {
        return $this->userCreator;
    }

    public function setUserCreator(?User $userCreator): static
    {
        $this->userCreator = $userCreator;

        return $this;
    }

    public function getImagePath(): ?string
    {
        return $this->imagePath;
    }

    public function setImagePath(?string $imagePath): static
    {
        $this->imagePath = $imagePath;

        return $this;
    }
}
