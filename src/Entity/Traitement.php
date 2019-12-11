<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TraitementRepository")
 */
class Traitement
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $traitement;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_traitement;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Bovin", inversedBy="traitemnts")
     */
    private $bovin;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTraitement(): ?string
    {
        return $this->traitement;
    }

    public function setTraitement(string $traitement): self
    {
        $this->traitement = $traitement;

        return $this;
    }

    public function getDateTraitement(): ?\DateTimeInterface
    {
        return $this->date_traitement;
    }

    public function setDateTraitement(\DateTimeInterface $date_traitement): self
    {
        $this->date_traitement = $date_traitement;

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
}
