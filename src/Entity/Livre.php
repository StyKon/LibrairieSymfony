<?php

namespace App\Entity;

use App\Repository\LivreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LivreRepository::class)
 */
class Livre
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $titre;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbPages;

    /**
     * @ORM\Column(type="date")
     */
    private $dateEdition;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $nbExemplaires;

    /**
     * @ORM\Column(type="integer")
     */
    private $prix;

    /**
     * @ORM\Column(type="integer")
     */
    private $isbn;

    /**
     * @ORM\ManyToOne(targetEntity=Editeur::class, inversedBy="livres")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Editeur;

    /**
     * @ORM\ManyToOne(targetEntity=Categorie::class, inversedBy="livres")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Categorie;

    /**
     * @ORM\ManyToMany(targetEntity=Auteur::class, inversedBy="livres")
     */
    private $Auteur;

    public function __construct()
    {
        $this->Auteur = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getNbPages(): ?int
    {
        return $this->nbPages;
    }

    public function setNbPages(int $nbPages): self
    {
        $this->nbPages = $nbPages;

        return $this;
    }

    public function getDateEdition(): ?\DateTimeInterface
    {
        return $this->dateEdition;
    }

    public function setDateEdition(\DateTimeInterface $dateEdition): self
    {
        $this->dateEdition = $dateEdition;

        return $this;
    }

    public function getNbExemplaires(): ?string
    {
        return $this->nbExemplaires;
    }

    public function setNbExemplaires(string $nbExemplaires): self
    {
        $this->nbExemplaires = $nbExemplaires;

        return $this;
    }

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getIsbn(): ?int
    {
        return $this->isbn;
    }

    public function setIsbn(int $isbn): self
    {
        $this->isbn = $isbn;

        return $this;
    }

    public function getEditeur(): ?Editeur
    {
        return $this->Editeur;
    }

    public function setEditeur(?Editeur $Editeur): self
    {
        $this->Editeur = $Editeur;

        return $this;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->Categorie;
    }

    public function setCategorie(?Categorie $Categorie): self
    {
        $this->Categorie = $Categorie;

        return $this;
    }

    /**
     * @return Collection|Auteur[]
     */
    public function getAuteur(): Collection
    {
        return $this->Auteur;
    }

    public function addAuteur(Auteur $auteur): self
    {
        if (!$this->Auteur->contains($auteur)) {
            $this->Auteur[] = $auteur;
        }

        return $this;
    }

    public function removeAuteur(Auteur $auteur): self
    {
        $this->Auteur->removeElement($auteur);

        return $this;
    }
    /**
     * toString
     * @return string
     */
    public function __toString(){
        return $this->getTitre();
    }
}
