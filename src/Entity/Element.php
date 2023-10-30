<?php

namespace App\Entity;

use App\Repository\ElementRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ElementRepository::class)]
class Element
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nameElement = null;

    #[ORM\Column]
    private ?int $advantage = null;

    #[ORM\Column]
    private ?int $disadvantage = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameElement(): ?string
    {
        return $this->nameElement;
    }

    public function setNameElement(string $nameElement): static
    {
        $this->nameElement = $nameElement;

        return $this;
    }

    public function getAdvantage(): ?int
    {
        return $this->advantage;
    }

    public function setAdvantage(int $advantage): static
    {
        $this->advantage = $advantage;

        return $this;
    }

    public function getDisadvantage(): ?int
    {
        return $this->disadvantage;
    }

    public function setDisadvantage(int $disadvantage): static
    {
        $this->disadvantage = $disadvantage;

        return $this;
    }
}
