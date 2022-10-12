<?php

namespace App\Entity;

use App\Repository\SortieRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SortieRepository::class)]
class Sortie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nom = null;

    #[ORM\Column]
    private ?int $nbInscriptionMax = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_enregistrement = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_ouverture_inscription = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_fermeture_inscription = null;

    #[ORM\Column]
    private ?bool $isAnnulee = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_debut_sortie = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_fin_sortie = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getNbInscriptionMax(): ?int
    {
        return $this->nbInscriptionMax;
    }

    public function setNbInscriptionMax(int $nbInscriptionMax): self
    {
        $this->nbInscriptionMax = $nbInscriptionMax;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDateEnregistrement(): ?\DateTimeInterface
    {
        return $this->date_enregistrement;
    }

    public function setDateEnregistrement(\DateTimeInterface $date_enregistrement): self
    {
        $this->date_enregistrement = $date_enregistrement;

        return $this;
    }

    public function getDateOuvertureInscription(): ?\DateTimeInterface
    {
        return $this->date_ouverture_inscription;
    }

    public function setDateOuvertureInscription(\DateTimeInterface $date_ouverture_inscription): self
    {
        $this->date_ouverture_inscription = $date_ouverture_inscription;

        return $this;
    }

    public function getDateFermetureInscription(): ?\DateTimeInterface
    {
        return $this->date_fermeture_inscription;
    }

    public function setDateFermetureInscription(\DateTimeInterface $date_fermeture_inscription): self
    {
        $this->date_fermeture_inscription = $date_fermeture_inscription;

        return $this;
    }

    public function isIsAnnulee(): ?bool
    {
        return $this->isAnnulee;
    }

    public function setIsAnnulee(bool $isAnnulee): self
    {
        $this->isAnnulee = $isAnnulee;

        return $this;
    }

    public function getDateDebutSortie(): ?\DateTimeInterface
    {
        return $this->date_debut_sortie;
    }

    public function setDateDebutSortie(\DateTimeInterface $date_debut_sortie): self
    {
        $this->date_debut_sortie = $date_debut_sortie;

        return $this;
    }

    public function getDateFinSortie(): ?\DateTimeInterface
    {
        return $this->date_fin_sortie;
    }

    public function setDateFinSortie(\DateTimeInterface $date_fin_sortie): self
    {
        $this->date_fin_sortie = $date_fin_sortie;

        return $this;
    }

}
