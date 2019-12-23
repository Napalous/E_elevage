<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommandeRepository")
 */
class Commande
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $datecommande;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Client", inversedBy="commandes")
     */
    private $clients;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Livraison", mappedBy="commande")
     */
    private $livraisons;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Facture", mappedBy="commande")
     */
    private $factures;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\DetailsCommande", mappedBy="commande")
     */
    private $detailscommande;

    public function __construct()
    {
        $this->livraisons = new ArrayCollection();
        $this->factures = new ArrayCollection();
        $this->detailscommande = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDatecommande(): ?\DateTimeInterface
    {
        return $this->datecommande;
    }

    public function setDatecommande(\DateTimeInterface $datecommande): self
    {
        $this->datecommande = $datecommande;

        return $this;
    }

    public function getClients(): ?Client
    {
        return $this->clients;
    }

    public function setClients(?Client $clients): self
    {
        $this->clients = $clients;

        return $this;
    }

    /**
     * @return Collection|Livraison[]
     */
    public function getLivraisons(): Collection
    {
        return $this->livraisons;
    }

    public function addLivraison(Livraison $livraison): self
    {
        if (!$this->livraisons->contains($livraison)) {
            $this->livraisons[] = $livraison;
            $livraison->setCommande($this);
        }

        return $this;
    }

    public function removeLivraison(Livraison $livraison): self
    {
        if ($this->livraisons->contains($livraison)) {
            $this->livraisons->removeElement($livraison);
            // set the owning side to null (unless already changed)
            if ($livraison->getCommande() === $this) {
                $livraison->setCommande(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Facture[]
     */
    public function getFactures(): Collection
    {
        return $this->factures;
    }

    public function addFacture(Facture $facture): self
    {
        if (!$this->factures->contains($facture)) {
            $this->factures[] = $facture;
            $facture->setCommande($this);
        }

        return $this;
    }

    public function removeFacture(Facture $facture): self
    {
        if ($this->factures->contains($facture)) {
            $this->factures->removeElement($facture);
            // set the owning side to null (unless already changed)
            if ($facture->getCommande() === $this) {
                $facture->setCommande(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|DetailsCommande[]
     */
    public function getDetailscommande(): Collection
    {
        return $this->detailscommande;
    }

    public function addDetailscommande(DetailsCommande $detailscommande): self
    {
        if (!$this->detailscommande->contains($detailscommande)) {
            $this->detailscommande[] = $detailscommande;
            $detailscommande->setCommande($this);
        }

        return $this;
    }

    public function removeDetailscommande(DetailsCommande $detailscommande): self
    {
        if ($this->detailscommande->contains($detailscommande)) {
            $this->detailscommande->removeElement($detailscommande);
            // set the owning side to null (unless already changed)
            if ($detailscommande->getCommande() === $this) {
                $detailscommande->setCommande(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return (string)$this->id;
    }
}
