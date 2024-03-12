<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ScoreTotalRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ScoreTotalRepository::class)]
#[ApiResource]
class ScoreTotal
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'scoreTotals')]
    private ?Pendu $scoreTotal = null;

    #[ORM\OneToMany(mappedBy: 'scorePendu', targetEntity: User::class)]
    private Collection $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getScoreTotal(): ?Pendu
    {
        return $this->scoreTotal;
    }

    public function setScoreTotal(?Pendu $scoreTotal): static
    {
        $this->scoreTotal = $scoreTotal;

        return $this;
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
            $user->setScorePendu($this);
        }

        return $this;
    }

    public function removeUser(User $user): static
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getScorePendu() === $this) {
                $user->setScorePendu(null);
            }
        }

        return $this;
    }
}
