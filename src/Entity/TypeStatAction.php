<?php

namespace App\Entity;

use App\Repository\TypeStatActionRepository;
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
}
