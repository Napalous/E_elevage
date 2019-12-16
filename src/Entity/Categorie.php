<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategorieRepository")
 * @UniqueEntity("libelle")
 */
class Categorie
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $libelle;

    /**
     * @ORM\Column(type="datetime")
     */
    private $datecreation;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Produit", mappedBy="categories")
     */
    private $produits;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Bovin", mappedBy="categories")
     */
    private $bovins;

    public function __construct()
    {
        $this->produits = new ArrayCollection();
        $this->bovins = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getDatecreation(): ?\DateTimeInterface
    {
        return $this->datecreation;
    }

    public function setDatecreation(\DateTimeInterface $datecreation): self
    {
        $this->datecreation = $datecreation;

        return $this;
    }

    /**
     * @return Collection|Produit[]
     */
    public function getProduits(): Collection
    {
        return $this->produits;
    }

    public function addProduit(Produit $produit): self
    {
        if (!$this->produits->contains($produit)) {
            $this->produits[] = $produit;
            $produit->setCategories($this);
        }

        return $this;
    }

    public function removeProduit(Produit $produit): self
    {
        if ($this->produits->contains($produit)) {
            $this->produits->removeElement($produit);
            // set the owning side to null (unless already changed)
            if ($produit->getCategories() === $this) {
                $produit->setCategories(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Bovin[]
     */
    public function getBovins(): Collection
    {
        return $this->bovins;
    }

    public function addBovin(Bovin $bovin): self
    {
        if (!$this->bovins->contains($bovin)) {
            $this->bovins[] = $bovin;
            $bovin->setCategories($this);
        }

        return $this;
    }

    public function removeBovin(Bovin $bovin): self
    {
        if ($this->bovins->contains($bovin)) {
            $this->bovins->removeElement($bovin);
            // set the owning side to null (unless already changed)
            if ($bovin->getCategories() === $this) {
                $bovin->setCategories(null);
            }
        }

        return $this;
    }

     public function __toString()
    {
        return (string)$this->libelle;
    }
}
