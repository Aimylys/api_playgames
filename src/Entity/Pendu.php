<?php

namespace App\Entity;

use App\Repository\PenduRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;

#[ORM\Entity(repositoryClass: PenduRepository::class)]
#[ApiResource(paginationItemsPerPage: 20,
operations:[new Get(normalizationContext: ['groups' => 'pendu:item']),
            new GetCollection(normalizationContext: ['groups' => 'pendu:list'])])]
class Pendu
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['pendu:list', 'pendu:item', 'penduscore:item'])]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['pendu:list', 'pendu:item', 'penduscore:item'])]
    private ?int $score = null;

    #[ORM\ManyToOne(inversedBy: 'pendus')]
    private ?User $user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getScore(): ?int
    {
        return $this->score;
    }

    public function setScore(?int $score): static
    {
        $this->score = $score;

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
