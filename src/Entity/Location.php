<?php

namespace App\Entity;

use App\Repository\LocationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LocationRepository::class)]
class Location
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_entree = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_sortie = null;

    #[ORM\Column]
    private ?bool $depot_garantie_verse = null;

    #[ORM\Column(nullable: true)]
    private ?bool $apl_versee = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateEntree(): ?\DateTimeInterface
    {
        return $this->date_entree;
    }

    public function setDateEntree(\DateTimeInterface $date_entree): self
    {
        $this->date_entree = $date_entree;

        return $this;
    }

    public function getDateSortie(): ?\DateTimeInterface
    {
        return $this->date_sortie;
    }

    public function setDateSortie(\DateTimeInterface $date_sortie): self
    {
        $this->date_sortie = $date_sortie;

        return $this;
    }

    public function isDepotGarantieVerse(): ?bool
    {
        return $this->depot_garantie_verse;
    }

    public function setDepotGarantieVerse(bool $depot_garantie_verse): self
    {
        $this->depot_garantie_verse = $depot_garantie_verse;

        return $this;
    }

    public function isAplVersee(): ?bool
    {
        return $this->apl_versee;
    }

    public function setAplVersee(?bool $apl_versee): self
    {
        $this->apl_versee = $apl_versee;

        return $this;
    }
}
