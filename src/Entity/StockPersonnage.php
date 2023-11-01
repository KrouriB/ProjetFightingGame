<?php

namespace App\Entity;

use App\Service\CreateRandom;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\PersonnageRepository;
use Doctrine\Common\Collections\Collection;
use App\Repository\StockPersonnageRepository;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: StockPersonnageRepository::class)]
class StockPersonnage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToMany(targetEntity: Personnage::class)]
    private Collection $personnages;

    #[ORM\ManyToOne(inversedBy: 'stockPersonnages')]
    private ?User $stockUser = null;

    public function __construct(CreateRandom $createRandom, PersonnageRepository $personnageRepository)
    {
        $personnages = $personnageRepository->findFirstPersonnages();
        $this->personnages = new ArrayCollection();
        $randomFive = $createRandom->createFiveRandom();
        foreach($randomFive as $random)
        {
            $this->addPersonnage($personnages[$random]);
        }
        dd($this->personnages);
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
