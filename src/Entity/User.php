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
    #[Groups(['user:list','user:item','pendu:list', 'pendu:item'])]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    #[Groups(['user:list','user:item','pendu:list', 'pendu:item'])]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    #[Groups(['user:list','user:item','pendu:list', 'pendu:item'])]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    #[Groups(['user:list','user:item','pendu:list', 'pendu:item'])]
    private ?string $prenom = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Groups(['user:list','user:item','pendu:list', 'pendu:item'])]
    private ?\DateTimeInterface $dateInscription = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['user:list','user:item','pendu:list', 'pendu:item'])]
    private ?int $points = null;

    #[ORM\ManyToOne(inversedBy: 'scoreTotal')]
    #[Groups(['user:list','user:item','pendu:list', 'pendu:item'])]
    private ?Pendu $scorePendu = null;

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

    public function getScorePendu(): ?Pendu
    {
        return $this->scorePendu;
    }

    public function setScorePendu(?Pendu $scorePendu): static
    {
        $this->scorePendu = $scorePendu;

        return $this;
    }
}
