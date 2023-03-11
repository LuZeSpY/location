<?php

namespace App\Entity;

use App\Repository\AgenceRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AgenceRepository::class)]
class Agence
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom_agence = null;

    #[ORM\Column]
    private ?float $taux_frais = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomAgence(): ?string
    {
        return $this->nom_agence;
    }

    public function setNomAgence(string $nom_agence): self
    {
        $this->nom_agence = $nom_agence;

        return $this;
    }

    public function getTauxFrais(): ?float
    {
        return $this->taux_frais;
    }

    public function setTauxFrais(float $taux_frais): self
    {
        $this->taux_frais = $taux_frais;

        return $this;
    }
}
