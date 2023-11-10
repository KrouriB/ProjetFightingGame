<?php

namespace App\Entity;

use App\Repository\StockWeaponRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StockWeaponRepository::class)]
class StockWeapon
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToMany(targetEntity: Weapon::class, inversedBy: 'stockWeapons')]
    private Collection $weapons;

    #[ORM\ManyToOne(inversedBy: 'stockWeapons')]
    #[ORM\JoinColumn(nullable: true)]
    private ?User $stockUser = null;

    public function __construct()
    {
        $this->weapons = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Weapon>
     */
    public function getWeapons(): Collection
    {
        return $this->weapons;
    }

    public function addWeapon(Weapon $weapon): static
    {
        if (!$this->weapons->contains($weapon)) {
            $this->weapons->add($weapon);
        }

        return $this;
    }

    public function removeWeapon(Weapon $weapon): static
    {
        $this->weapons->removeElement($weapon);

        return $this;
    }

    public function getStockUser(): ?User
    {
        return $this->stockUser;
    }

    public function setStockUser(?User $stockUser): static
    {
        $this->stockUser = $stockUser;

        return $this;
    }
}
