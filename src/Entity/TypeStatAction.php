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

    #[ORM\Column(length: 30, nullable: true)]
    private ?string $nomStat = null;

    #[ORM\Column(length: 30)]
    private ?string $nomType = null;

    #[ORM\OneToMany(mappedBy: 'typeStatAction', targetEntity: Accessory::class, orphanRemoval: true)]
    private Collection $accessorys;

    #[ORM\Column(nullable: false)]
    private ?int $rankStat1 = null;

    #[ORM\Column(nullable: false)]
    private ?int $rankStat2 = null;

    #[ORM\Column(nullable: false)]
    private ?int $rankStat3 = null;

    #[ORM\Column(nullable: false)]
    private ?int $rankStat4 = null;

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

    public function getRankStat1(): ?int
    {
        return $this->rankStat1;
    }

    public function setRankStat1(?int $rankStat1): static
    {
        $this->rankStat1 = $rankStat1;

        return $this;
    }

    public function getRankStat2(): ?int
    {
        return $this->rankStat2;
    }

    public function setRankStat2(?int $rankStat2): static
    {
        $this->rankStat2 = $rankStat2;

        return $this;
    }

    public function getRankStat3(): ?int
    {
        return $this->rankStat3;
    }

    public function setRankStat3(?int $rankStat3): static
    {
        $this->rankStat3 = $rankStat3;

        return $this;
    }

    public function getRankStat4(): ?int
    {
        return $this->rankStat4;
    }

    public function setRankStat4(?int $rankStat4): static
    {
        $this->rankStat4 = $rankStat4;

        return $this;
    }

    public function __toString()
    {
        return $this->nomType.' ( '.$this->nomStat.' ), rank 1 : '.$this->rankStat1.'% , rank 2 : '.$this->rankStat2.'% , rank 3 : '.$this->rankStat3.'% , rank 4 : '.$this->rankStat4.'%';
    }
}
