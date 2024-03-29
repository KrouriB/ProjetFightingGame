<?php

namespace App\Entity;

use App\Entity\Equipe;
use App\Entity\StockWeapon;
use App\Entity\StockAccessory;
use App\Entity\StockPersonnage;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[UniqueEntity(fields: ['username'], message: 'There is already an account with this username')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $username = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column]
    private ?int $gold = null;

    #[ORM\Column]
    private ?int $killCount = null;

    #[ORM\Column]
    private ?int $winCount = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\OneToMany(mappedBy: 'assosiatedUser', targetEntity: Equipe::class)]
    private Collection $equipes;

    #[ORM\Column(type: 'boolean')]
    private $isVerified = false;

    #[ORM\OneToMany(mappedBy: 'stockUser', targetEntity: StockPersonnage::class, orphanRemoval: true)]
    private Collection $stockPersonnages;

    #[ORM\OneToMany(mappedBy: 'stockUser', targetEntity: StockWeapon::class, orphanRemoval: true)]
    private Collection $stockWeapons;

    #[ORM\OneToMany(mappedBy: 'stockUser', targetEntity: StockAccessory::class, orphanRemoval: true)]
    private Collection $stockAccessorys;

    public function __construct()
    {
        $this->stockPersonnages = new ArrayCollection();
        $this->stockWeapons = new ArrayCollection();
        $this->stockAccessorys = new ArrayCollection();
        $this->equipes = new ArrayCollection();
        $this->gold = 1000;
        $this->killCount = 0;
        $this->winCount = 0;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): static
    {
        $this->username = $username;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->username;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getGold(): ?int
    {
        return $this->gold;
    }

    public function setGold(int $gold): static
    {
        $this->gold = $gold;

        return $this;
    }

    public function getKillCount(): ?int
    {
        return $this->killCount;
    }

    public function setKillCount(int $killCount): static
    {
        $this->killCount = $killCount;

        return $this;
    }

    public function getWinCount(): ?int
    {
        return $this->winCount;
    }

    public function setWinCount(int $winCount): static
    {
        $this->winCount = $winCount;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return Collection<int, StockPersonnage>
     */
    public function getStockPersonnages(): Collection
    {
        return $this->stockPersonnages;
    }

    public function addStockPersonnage(StockPersonnage $stockPersonnage): static
    {
        if (!$this->stockPersonnages->contains($stockPersonnage)) {
            $this->stockPersonnages->add($stockPersonnage);
            $stockPersonnage->setStockUser($this);
        }

        return $this;
    }

    public function removeStockPersonnage(StockPersonnage $stockPersonnage): static
    {
        if ($this->stockPersonnages->removeElement($stockPersonnage)) {
            // set the owning side to null (unless already changed)
            if ($stockPersonnage->getStockUser() === $this) {
                $stockPersonnage->setStockUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, StockWeapon>
     */
    public function getStockWeapons(): Collection
    {
        return $this->stockWeapons;
    }

    public function addStockWeapon(StockWeapon $stockWeapon): static
    {
        if (!$this->stockWeapons->contains($stockWeapon)) {
            $this->stockWeapons->add($stockWeapon);
            $stockWeapon->setStockUser($this);
        }

        return $this;
    }

    public function removeStockWeapon(StockWeapon $stockWeapon): static
    {
        if ($this->stockWeapons->removeElement($stockWeapon)) {
            // set the owning side to null (unless already changed)
            if ($stockWeapon->getStockUser() === $this) {
                $stockWeapon->setStockUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, StockAccessory>
     */
    public function getStockAccessorys(): Collection
    {
        return $this->stockAccessorys;
    }

    public function addStockAccessory(StockAccessory $stockAccessory): static
    {
        if (!$this->stockAccessorys->contains($stockAccessory)) {
            $this->stockAccessorys->add($stockAccessory);
            $stockAccessory->setStockUser($this);
        }

        return $this;
    }

    public function removeStockAccessory(StockAccessory $stockAccessory): static
    {
        if ($this->stockAccessorys->removeElement($stockAccessory)) {
            // set the owning side to null (unless already changed)
            if ($stockAccessory->getStockUser() === $this) {
                $stockAccessory->setStockUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Equipe>
     */
    public function getEquipes(): Collection
    {
        return $this->equipes;
    }

    public function addEquipe(Equipe $equipe): static
    {
        if (!$this->equipes->contains($equipe)) {
            $this->equipes->add($equipe);
            $equipe->setAssosiatedUser($this);
        }

        return $this;
    }

    public function removeEquipe(Equipe $equipe): static
    {
        if ($this->equipes->removeElement($equipe)) {
            // set the owning side to null (unless already changed)
            if ($equipe->getAssosiatedUser() === $this) {
                $equipe->setAssosiatedUser(null);
            }
        }

        return $this;
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): static
    {
        $this->isVerified = $isVerified;

        return $this;
    }

    public function loseGame(): static
    {
        if($this->winCount > 0)
        {
            $this->setWinCount($this->winCount - 1);
        }
        // dd($this->winCount);

        return $this;
    }

    public function winGame(): static
    {
        $this->setWinCount($this->winCount + 1);
        // dd($this->winCount);
        $this->setGold($this->gold + 500);

        return $this;
    }

    public function createPersonnage(): static
    {
        $this->setGold($this->gold - 2000);

        return $this;
    }

    public function createWeapon(int $gold): static
    {
        $this->setGold($this->gold - $gold);

        return $this;
    }
    
    public function __toString()
    {
        return $this->username;
    }
}
