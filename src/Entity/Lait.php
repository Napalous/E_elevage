<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LaitRepository")
 */
class Lait
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="decimal", precision=6, scale=2)
     */
    private $quantite;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_production;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Bovin", inversedBy="laits")
     */
    private $bovin;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Stock", mappedBy="laits")
     */
    private $stocks;

    public function __construct()
    {
        $this->stocks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantite(): ?string
    {
        return $this->quantite;
    }

    public function setQuantite(string $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getDateProduction(): ?\DateTimeInterface
    {
        return $this->date_production;
    }

    public function setDateProduction(\DateTimeInterface $date_production): self
    {
        $this->date_production = $date_production;

        return $this;
    }

    public function getBovin(): ?Bovin
    {
        return $this->bovin;
    }

    public function setBovin(?Bovin $bovin): self
    {
        $this->bovin = $bovin;

        return $this;
    }

    /**
     * @return Collection|Stock[]
     */
    public function getStocks(): Collection
    {
        return $this->stocks;
    }

    public function addStock(Stock $stock): self
    {
        if (!$this->stocks->contains($stock)) {
            $this->stocks[] = $stock;
            $stock->setLaits($this);
        }

        return $this;
    }

    public function removeStock(Stock $stock): self
    {
        if ($this->stocks->contains($stock)) {
            $this->stocks->removeElement($stock);
            // set the owning side to null (unless already changed)
            if ($stock->getLaits() === $this) {
                $stock->setLaits(null);
            }
        }

        return $this;
    }

}
