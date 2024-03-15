<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\MemoryRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MemoryRepository::class)]
#[ApiResource]
class Memory
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
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
