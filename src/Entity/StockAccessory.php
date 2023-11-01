<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\AccessoryRepository;
use Doctrine\Common\Collections\Collection;
use App\Repository\StockAccessoryRepository;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: StockAccessoryRepository::class)]
class StockAccessory
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToMany(targetEntity: Accessory::class)]
    private Collection $accesorys;

    #[ORM\ManyToOne(inversedBy: 'stockAccesorys')]
    private ?User $stockUser = null;

    public function __construct(AccessoryRepository $accessoryRepository)
    {
        $accessory = $accessoryRepository->findFirstAccessory();
        $this->accesorys = new ArrayCollection();
        $this->addAccesory($accesory);
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
