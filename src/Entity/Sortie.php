<?php

namespace App\Entity;

use App\Repository\SortieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: SortieRepository::class)]
class Sortie
{

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;


    #[ORM\Column(length: 50)]
    #[Assert\Length(
        min : 3,
        max : 50,
        minMessage : "Un effort dans votre, vous devez ajoutez au moins {{ limit }} caractères ",
        maxMessage : "Votre saisie ne doit pas dépasser {{limit}} caractères" )]
    private ?string $nom = null;

    #[ORM\Column]
    private ?int $nbInscriptionMax = null;

    #[ORM\Column(length: 255)]
    #[Assert\Length(
        min : 5 ,
        max : 255,
        minMessage : "Un effort dans la saisie, vous devez ajoutez au moins {{ limit }} caractères ",
        maxMessage : "Votre saisie ne doit pas dépasser {{ limit }} caractères" )]
    private ?string $description = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    //#[Assert\DateTime( format : 'Y-m-d H:i')]
    #[Assert\Type("\DateTimeInterface")]
    private ?\DateTimeInterface $date_enregistrement = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    //#[Assert\DateTime( format : 'Y-m-d H:i')]
    #[Assert\Type("\DateTimeInterface")]
    private ?\DateTimeInterface $date_ouverture_inscription = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    //#[Assert\DateTime( format : 'Y-m-d H:i')]
    #[Assert\Type("\DateTimeInterface")]
    private ?\DateTimeInterface $date_fermeture_inscription = null;

    #[ORM\Column]
    private ?bool $isAnnulee = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    //#[Assert\DateTime( format : 'Y-m-d H:i')]
    #[Assert\Type("\DateTimeInterface")]
    private ?\DateTimeInterface $date_debut_sortie = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    //#[Assert\DateTime( format : 'Y-m-d H:i')]
    #[Assert\Type("\DateTimeInterface")]
    private ?\DateTimeInterface $date_fin_sortie = null;

    #[ORM\ManyToOne(inversedBy: 'sortie')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Utilisateur $organisateur = null;

    #[ORM\OneToMany(mappedBy: 'sortie', targetEntity: Inscription::class)]
    //TODO Change it to inscriptions
    private Collection $sortie;

    #[ORM\OneToMany(mappedBy: 'sortie', targetEntity: PhotoSortie::class)]
    private Collection $photoSortie;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Lieu $adresse = null;

    //TODO changer les porter à private + getter et setter
    private ?string $etat;
    private ?int $nbInscrit;
    private ?bool $estInscrit;
    private ?\DateInterval $duree;

    /**
     * @return string|null
     */
    public function getEtat(): ?string
    {
        return $this->etat;
    }

    /**
     * @param string|null $etat
     */
    public function setEtat(?string $etat): void
    {
        $this->etat = $etat;
    }

    /**
     * @return int|null
     */
    public function getNbInscrit(): ?int
    {
        return $this->nbInscrit;
    }

    /**
     * @param int|null $nbInscrit
     */
    public function setNbInscrit(?int $nbInscrit): void
    {
        $this->nbInscrit = $nbInscrit;
    }

    /**
     * @return bool|null
     */
    public function getEstInscrit(): ?bool
    {
        return $this->estInscrit;
    }

    /**
     * @param bool|null $estInscrit
     */
    public function setEstInscrit(?bool $estInscrit): void
    {
        $this->estInscrit = $estInscrit;
    }

    /**
     * @return bool|null
     */
    public function getDuree(): ?\DateInterval
    {
        return $this->duree;
    }

    /**
     * @param bool|null $duree
     */
    public function setDuree(?\DateInterval $duree): void
    {
        $this->duree = $duree;
    }

    public function __construct()
    {
        $this->sortie = new ArrayCollection();
        $this->photoSortie = new ArrayCollection();
    }

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

    public function getOrganisateur(): ?Utilisateur
    {
        return $this->organisateur;
    }

    public function setOrganisateur(?Utilisateur $organisateur): self
    {
        $this->organisateur = $organisateur;

        return $this;
    }

    /**
     * @return Collection<int, Inscription>
     */
    public function getSortie(): Collection
    {
        return $this->sortie;
    }

    public function addSortie(Inscription $sortie): self
    {
        if (!$this->sortie->contains($sortie)) {
            $this->sortie->add($sortie);
            $sortie->setSortie($this);
        }

        return $this;
    }

    public function removeSortie(Inscription $sortie): self
    {
        if ($this->sortie->removeElement($sortie)) {
            // set the owning side to null (unless already changed)
            if ($sortie->getSortie() === $this) {
                $sortie->setSortie(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, PhotoSortie>
     */
    public function getPhotoSortie(): Collection
    {
        return $this->photoSortie;
    }

    public function addPhotoSortie(PhotoSortie $photoSortie): self
    {
        if (!$this->photoSortie->contains($photoSortie)) {
            $this->photoSortie->add($photoSortie);
            $photoSortie->setSortie($this);
        }

        return $this;
    }

    public function removePhotoSortie(PhotoSortie $photoSortie): self
    {
        if ($this->photoSortie->removeElement($photoSortie)) {
            // set the owning side to null (unless already changed)
            if ($photoSortie->getSortie() === $this) {
                $photoSortie->setSortie(null);
            }
        }

        return $this;
    }

    public function getAdresse(): ?Lieu
    {
        return $this->adresse;
    }

    public function setAdresse(?Lieu $adresse): self
    {
        $this->adresse = $adresse;

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
