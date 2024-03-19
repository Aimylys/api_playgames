<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\MemoryRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;

#[ORM\Entity(repositoryClass: MemoryRepository::class)]
#[ApiResource(paginationItemsPerPage: 20,
operations:[new Get(normalizationContext: ['groups' => 'memory:item']),
            new GetCollection(normalizationContext: ['groups' => 'memory:list']),
            new Post(normalizationContext: ['groups' => 'memory:item']),])]
class Memory
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['memory:list', 'memory:item', 'memoryscore:item'])]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['memory:list', 'memory:item', 'memoryscore:item'])]
    private ?int $scoreM = null;

    #[ORM\ManyToOne(inversedBy: 'scoreMemory')]
    private ?User $user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getScoreM(): ?int
    {
        return $this->scoreM;
    }

    public function setScoreM(?int $scoreM): static
    {
        $this->scoreM = $scoreM;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }
}
