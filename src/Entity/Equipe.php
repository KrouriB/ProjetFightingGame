<?php

namespace App\Entity;

use App\Repository\EquipeRepository;
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
}
