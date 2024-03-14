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

    #[ORM\OneToMany(mappedBy: 'scoreTotal', targetEntity: ScoreTotal::class)]
    #[Groups(['pendu:list', 'pendu:item', 'penduscore:item'])]
    private Collection $scoreTotals;

    #[ORM\Column(nullable: true)]
    #[Groups(['pendu:list', 'pendu:item', 'penduscore:item'])]
    private ?int $score = null;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->scoreTotals = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): static
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->addScorePendu($this);
        }

        return $this;
    }

    public function removeUser(User $user): static
    {
        if ($this->users->removeElement($user)) {
            $user->removeScorePendu($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, ScoreTotal>
     */
    public function getScoreTotals(): Collection
    {
        return $this->scoreTotals;
    }

    public function addScoreTotal(ScoreTotal $scoreTotal): static
    {
        if (!$this->scoreTotals->contains($scoreTotal)) {
            $this->scoreTotals->add($scoreTotal);
            $scoreTotal->setScoreTotal($this);
        }

        return $this;
    }

    public function removeScoreTotal(ScoreTotal $scoreTotal): static
    {
        if ($this->scoreTotals->removeElement($scoreTotal)) {
            // set the owning side to null (unless already changed)
            if ($scoreTotal->getScoreTotal() === $this) {
                $scoreTotal->setScoreTotal(null);
            }
        }

        return $this;
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

}
