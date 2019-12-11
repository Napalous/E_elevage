<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DetailsCommandeRepository")
 */
class DetailsCommande
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $qtecommandee;

    /**
     * @ORM\Column(type="integer")
     */
    private $prix_unitaire;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Produit", inversedBy="detailsCommandes")
     */
    private $produits;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Commande", inversedBy="detailscommande")
     */
    private $commande;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQtecommandee(): ?int
    {
        return $this->qtecommandee;
    }

    public function setQtecommandee(int $qtecommandee): self
    {
        $this->qtecommandee = $qtecommandee;

        return $this;
    }

    public function getPrixUnitaire(): ?int
    {
        return $this->prix_unitaire;
    }

    public function setPrixUnitaire(int $prix_unitaire): self
    {
        $this->prix_unitaire = $prix_unitaire;

        return $this;
    }

    public function getProduits(): ?Produit
    {
        return $this->produits;
    }

    public function setProduits(?Produit $produits): self
    {
        $this->produits = $produits;

        return $this;
    }

    public function getCommande(): ?Commande
    {
        return $this->commande;
    }

    public function setCommande(?Commande $commande): self
    {
        $this->commande = $commande;

        return $this;
    }
}
