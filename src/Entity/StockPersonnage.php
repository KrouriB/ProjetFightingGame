<?php

namespace App\Entity;

use App\Repository\StockPersonnageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StockPersonnageRepository::class)]
class StockPersonnage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToMany(targetEntity: Personnage::class, inversedBy: 'stockPersonnages')]
    private Collection $personnages;

    #[ORM\ManyToOne(inversedBy: 'stockPersonnages')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $stockUser = null;

    public function __construct()
    {
        $this->personnages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Personnage>
     */
    public function getPersonnages(): Collection
    {
        return $this->personnages;
    }

    public function addPersonnage(Personnage $personnage): static
    {
        if (!$this->personnages->contains($personnage)) {
            $this->personnages->add($personnage);
        }

        return $this;
    }

    public function removePersonnage(Personnage $personnage): static
    {
        $this->personnages->removeElement($personnage);

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
