<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\PenduRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PenduRepository::class)]
#[ApiResource]
class Pendu
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?int $score = null;

    #[ORM\Column(nullable: true)]
    private ?int $scoreTotalPendu = null;

    #[ORM\OneToMany(mappedBy: 'scorePendu', targetEntity: User::class)]
    private Collection $scoreTotal;

    public function __construct()
    {
        $this->scoreTotal = new ArrayCollection();
    }

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

    public function getScoreTotalPendu(): ?int
    {
        return $this->scoreTotalPendu;
    }

    public function setScoreTotalPendu(?int $scoreTotalPendu): static
    {
        $this->scoreTotalPendu = $scoreTotalPendu;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getScoreTotal(): Collection
    {
        return $this->scoreTotal;
    }

    public function addScoreTotal(User $scoreTotal): static
    {
        if (!$this->scoreTotal->contains($scoreTotal)) {
            $this->scoreTotal->add($scoreTotal);
            $scoreTotal->setScorePendu($this);
        }

        return $this;
    }

    public function removeScoreTotal(User $scoreTotal): static
    {
        if ($this->scoreTotal->removeElement($scoreTotal)) {
            // set the owning side to null (unless already changed)
            if ($scoreTotal->getScorePendu() === $this) {
                $scoreTotal->setScorePendu(null);
            }
        }

        return $this;
    }
}
