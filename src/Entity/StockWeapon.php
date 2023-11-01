<?php

namespace App\Entity;

use App\Entity\Weapon;
use App\Entity\Personnage;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\WeaponRepository;
use App\Repository\StockWeaponRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: StockWeaponRepository::class)]
class StockWeapon
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToMany(targetEntity: Weapon::class)]
    private Collection $weapons;

    #[ORM\ManyToOne(inversedBy: 'stockWeapons')]
    private ?User $stockUser = null;

    public function __construct(WeaponRepository $weaponRepository)
    {
        $weapons = $weaponRepository->findFirstWeapons();
        $this->weapons = new ArrayCollection();
        foreach($weapons as $weapon)
        {
            $this->addWeapon($weapon);
        }
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
