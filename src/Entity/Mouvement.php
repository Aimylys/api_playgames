<?php

namespace App\Entity;

use App\Repository\MouvementRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MouvementRepository::class)]
class Mouvement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $position_depart = null;

    #[ORM\Column(length: 255)]
    private ?string $position_arrivee = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateMouvement = null;

    #[ORM\Column(length: 255)]
    private ?string $typeMouvement = null;

    #[ORM\ManyToOne(inversedBy: 'mouvements')]
    private ?User $joueurId = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPositionDepart(): ?string
    {
        return $this->position_depart;
    }

    public function setPositionDepart(string $position_depart): static
    {
        $this->position_depart = $position_depart;

        return $this;
    }

    public function getPositionArrivee(): ?string
    {
        return $this->position_arrivee;
    }

    public function setPositionArrivee(string $position_arrivee): static
    {
        $this->position_arrivee = $position_arrivee;

        return $this;
    }

    public function getDateMouvement(): ?\DateTimeInterface
    {
        return $this->dateMouvement;
    }

    public function setDateMouvement(\DateTimeInterface $dateMouvement): static
    {
        $this->dateMouvement = $dateMouvement;

        return $this;
    }

    public function getTypeMouvement(): ?string
    {
        return $this->typeMouvement;
    }

    public function setTypeMouvement(string $typeMouvement): static
    {
        $this->typeMouvement = $typeMouvement;

        return $this;
    }

    public function getJoueurId(): ?User
    {
        return $this->joueurId;
    }

    public function setJoueurId(?User $joueurId): static
    {
        $this->joueurId = $joueurId;

        return $this;
    }
}
