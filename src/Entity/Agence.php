<?php

namespace App\Entity;

use App\Repository\AgenceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    #[ORM\OneToMany(mappedBy: 'agence', targetEntity: Appartement::class, orphanRemoval: true)]
    private Collection $appartements;

    public function __construct()
    {
        $this->appartements = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, Appartement>
     */
    public function getAppartements(): Collection
    {
        return $this->appartements;
    }

    public function addAppartement(Appartement $appartement): self
    {
        if (!$this->appartements->contains($appartement)) {
            $this->appartements->add($appartement);
            $appartement->setAgence($this);
        }

        return $this;
    }

    public function removeAppartement(Appartement $appartement): self
    {
        if ($this->appartements->removeElement($appartement)) {
            // set the owning side to null (unless already changed)
            if ($appartement->getAgence() === $this) {
                $appartement->setAgence(null);
            }
        }

        return $this;
    }
}
