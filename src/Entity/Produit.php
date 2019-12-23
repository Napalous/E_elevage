<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProduitRepository")
 */
class Produit
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
     * @ORM\Column(type="integer")
     */
    private $prix;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Categorie", inversedBy="produits")
     */
    private $categories;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\DetailsCommande", mappedBy="produits")
     */
    private $detailsCommandes;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $photo;

    public function __construct()
    {
        $this->detailsCommandes = new ArrayCollection();
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

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getCategories(): ?Categorie
    {
        return $this->categories;
    }

    public function setCategories(?Categorie $categories): self
    {
        $this->categories = $categories;

        return $this;
    }

    /**
     * @return Collection|DetailsCommande[]
     */
    public function getDetailsCommandes(): Collection
    {
        return $this->detailsCommandes;
    }

    public function addDetailsCommande(DetailsCommande $detailsCommande): self
    {
        if (!$this->detailsCommandes->contains($detailsCommande)) {
            $this->detailsCommandes[] = $detailsCommande;
            $detailsCommande->setProduits($this);
        }

        return $this;
    }

    public function removeDetailsCommande(DetailsCommande $detailsCommande): self
    {
        if ($this->detailsCommandes->contains($detailsCommande)) {
            $this->detailsCommandes->removeElement($detailsCommande);
            // set the owning side to null (unless already changed)
            if ($detailsCommande->getProduits() === $this) {
                $detailsCommande->setProduits(null);
            }
        }

        return $this;
    }

    public function getPhoto()
    {
        return $this->photo;
    }

    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }

    public function __toString()
    {
        return (string)$this->libelle;
    }
}
