<?php

namespace App\Entity;

use App\Repository\StockAccessoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StockAccessoryRepository::class)]
class StockAccessory
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToMany(targetEntity: Accessory::class)]
    private Collection $accesorys;

    public function __construct()
    {
        $this->accesorys = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Accessory>
     */
    public function getAccesorys(): Collection
    {
        return $this->accesorys;
    }

    public function addAccesory(Accessory $accesory): static
    {
        if (!$this->accesorys->contains($accesory)) {
            $this->accesorys->add($accesory);
        }

        return $this;
    }

    public function removeAccesory(Accessory $accesory): static
    {
        $this->accesorys->removeElement($accesory);

        return $this;
    }
}
