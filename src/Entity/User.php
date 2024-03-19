<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Metadata\Post;
use App\State\UserStateProcessor;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(paginationItemsPerPage: 20,
operations:[new Get(normalizationContext: ['groups' => 'user:item']),
            new Post(processor: UserStateProcessor::class),
            new GetCollection(normalizationContext: ['groups' => 'user:list']),
            new Patch(security: "is_granted('ROLE_ADMIN') or object == user")])]
#[ApiFilter(SearchFilter::class, properties:['id'=>'exact','email'=>'exact','nom'=> 'exact','prenom'=>'partial'])]
#[ApiFilter(OrderFilter::class, properties:['points'=> 'DESC'])]
#[ORM\Entity(repositoryClass: UserRepository::class)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['user:list','user:item','pendu:list', 'pendu:item', 'memory:list', 'memory:item'])]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    #[Groups(['user:list','user:item','pendu:list', 'pendu:item', 'memory:list', 'memory:item'])]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    #[Groups(['user:list','user:item','pendu:list', 'pendu:item', 'penduscore:item', 'memory:list', 'memory:item'])]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    #[Groups(['user:list','user:item','pendu:list', 'pendu:item', 'penduscore:item', 'memory:list', 'memory:item'])]
    private ?string $prenom = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Groups(['user:list','user:item','pendu:list', 'pendu:item', 'penduscore:item', 'memory:list', 'memory:item'])]
    private ?\DateTimeInterface $dateInscription = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['user:list','user:item','pendu:list', 'pendu:item', 'penduscore:item', 'memory:list', 'memory:item'])]
    private ?int $points = null;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Memory::class)]
    #[Groups(['user:list','user:item', 'memory:item'])]
    private Collection $scoreMemory;

    #[ORM\Column(nullable: true)]
    private ?int $totalMemoryScore = null;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Pendu::class)]
    private Collection $pendus;

    #[ORM\Column]
    private ?int $totalPenduScore = null;

    public function __construct()
    {
        $this->scoreMemory = new ArrayCollection();
        $this->pendus = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
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

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getDateInscription(): ?\DateTimeInterface
    {
        return $this->dateInscription;
    }

    public function setDateInscription(\DateTimeInterface $dateInscription): static
    {
        $this->dateInscription = $dateInscription;

        return $this;
    }

    public function getPoints(): ?int
    {
        return $this->points;
    }

    public function setPoints(?int $points): static
    {
        $this->points = $points;

        return $this;
    }


    /**
     * @return Collection<int, Memory>
     */
    public function getScoreMemory(): Collection
    {
        return $this->scoreMemory;
    }

    public function addScoreMemory(Memory $scoreMemory): static
    {
        if (!$this->scoreMemory->contains($scoreMemory)) {
            $this->scoreMemory->add($scoreMemory);
            $scoreMemory->setUser($this);
        }

        return $this;
    }

    public function removeScoreMemory(Memory $scoreMemory): static
    {
        if ($this->scoreMemory->removeElement($scoreMemory)) {
            // set the owning side to null (unless already changed)
            if ($scoreMemory->getUser() === $this) {
                $scoreMemory->setUser(null);
            }
        }

        return $this;
    }


    public function getTotalScoreMemory(): int
    {
        $totalScore = 0;
        foreach ($this->scoreMemory as $memory) {
            $totalScore += $memory->getScoreM();
        }
        return $totalScore;
    }

    public function setTotalMemoryScore(?int $totalMemoryScore): static
    {
        $this->totalMemoryScore = $totalMemoryScore;

        return $this;
    }

    /**
     * @return Collection<int, Pendu>
     */
    public function getPendus(): Collection
    {
        return $this->pendus;
    }

    public function addPendu(Pendu $pendu): static
    {
        if (!$this->pendus->contains($pendu)) {
            $this->pendus->add($pendu);
            $pendu->setUser($this);
        }

        return $this;
    }

    public function removePendu(Pendu $pendu): static
    {
        if ($this->pendus->removeElement($pendu)) {
            // set the owning side to null (unless already changed)
            if ($pendu->getUser() === $this) {
                $pendu->setUser(null);
            }
        }

        return $this;
    }

    public function getTotalPenduScore(): ?int
    {
        return $this->totalPenduScore;
    }

    public function setTotalPenduScore(int $totalPenduScore): static
    {
        $this->totalPenduScore = $totalPenduScore;

        return $this;
    }

}
