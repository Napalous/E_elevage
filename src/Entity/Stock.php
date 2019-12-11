<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\StockRepository")
 */
class Stock
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=0)
     */
    private $quantite;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_stock;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Lait", inversedBy="stocks")
     */
    private $laits;

    public function __construct()
    {
        $this->laits = new ArrayCollection();
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

    public function getDateStock(): ?\DateTimeInterface
    {
        return $this->date_stock;
    }

    public function setDateStock(\DateTimeInterface $date_stock): self
    {
        $this->date_stock = $date_stock;

        return $this;
    }

      public function __toString()
    {
        return (string)$this->quantite;
    }

      public function getLaits(): ?Lait
      {
          return $this->laits;
      }

      public function setLaits(?Lait $laits): self
      {
          $this->laits = $laits;

          return $this;
      }
}
