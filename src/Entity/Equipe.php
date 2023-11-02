<?php

namespace App\Entity;

use App\Repository\EquipeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EquipeRepository::class)]
class Equipe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private ?string $teamName = null;

    #[ORM\ManyToOne(inversedBy: 'equipes')]
    private ?User $assosiatedUser = null;

    #[ORM\ManyToMany(targetEntity: Personnage::class)]
    private Collection $personnages;

    #[ORM\ManyToMany(targetEntity: Accessory::class)]
    private Collection $equipement;

    #[ORM\ManyToMany(targetEntity: Weapon::class)]
    private Collection $weapon;

    public function __construct()
    {
        $this->personnages = new ArrayCollection();
        $this->equipement = new ArrayCollection();
        $this->weapon = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTeamName(): ?string
    {
        return $this->teamName;
    }

    public function setTeamName(string $teamName): static
    {
        $this->teamName = $teamName;

        return $this;
    }

    public function getAssosiatedUser(): ?User
    {
        return $this->assosiatedUser;
    }

    public function setAssosiatedUser(?User $assosiatedUser): static
    {
        $this->assosiatedUser = $assosiatedUser;

        return $this;
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

    /**
     * @return Collection<int, Accessory>
     */
    public function getEquipement(): Collection
    {
        return $this->equipement;
    }

    public function addEquipement(Accessory $equipement): static
    {
        if (!$this->equipement->contains($equipement)) {
            $this->equipement->add($equipement);
        }

        return $this;
    }

    public function removeEquipement(Accessory $equipement): static
    {
        $this->equipement->removeElement($equipement);

        return $this;
    }

    /**
     * @return Collection<int, Weapon>
     */
    public function getWeapon(): Collection
    {
        return $this->weapon;
    }

    public function addWeapon(Weapon $weapon): static
    {
        if (!$this->weapon->contains($weapon)) {
            $this->weapon->add($weapon);
        }

        return $this;
    }

    public function removeWeapon(Weapon $weapon): static
    {
        $this->weapon->removeElement($weapon);

        return $this;
    }
}
