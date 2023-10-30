<?php

namespace App\Entity;

use App\Repository\TypeStatActionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TypeStatActionRepository::class)]
class TypeStatAction
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 30)]
    private ?string $nomStat = null;

    #[ORM\Column(length: 30)]
    private ?string $nomType = null;

    #[ORM\OneToMany(mappedBy: 'typeStatAction', targetEntity: Accessory::class, orphanRemoval: true)]
    private Collection $accessorys;

    public function __construct()
    {
        $this->accessorys = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomStat(): ?string
    {
        return $this->nomStat;
    }

    public function setNomStat(string $nomStat): static
    {
        $this->nomStat = $nomStat;

        return $this;
    }

    public function getNomType(): ?string
    {
        return $this->nomType;
    }

    public function setNomType(string $nomType): static
    {
        $this->nomType = $nomType;

        return $this;
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
            $accessory->setTypeStatAction($this);
        }

        return $this;
    }

    public function removeAccessory(Accessory $accessory): static
    {
        if ($this->accessorys->removeElement($accessory)) {
            // set the owning side to null (unless already changed)
            if ($accessory->getTypeStatAction() === $this) {
                $accessory->setTypeStatAction(null);
            }
        }

        return $this;
    }
}
