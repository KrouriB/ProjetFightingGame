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

    #[ORM\ManyToMany(targetEntity: Accessory::class, inversedBy: 'stockAccessorys')]
    private Collection $accessorys;

    #[ORM\ManyToOne(inversedBy: 'stockAccessorys')]
    #[ORM\JoinColumn(nullable: true)]
    private ?User $stockUser = null;

    public function __construct()
    {
        $this->accessorys = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Accessory>
     */
    public function getAccessorys(): Collection
    {
        return $this->accessorys;
    }

    public function addAccessory(Accessory $accessory): static
    {
        if (!$this->accessorys->contains($accessory)) {
            $this->accessorys->add($accessory);
        }

        return $this;
    }

    public function removeAccessory(Accessory $accessory): static
    {
        $this->accessorys->removeElement($accessory);

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
