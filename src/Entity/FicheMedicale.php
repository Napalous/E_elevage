<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FicheMedicaleRepository")
 */
class FicheMedicale
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
    private $observation;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_consultation;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Bovin", inversedBy="fichemedical")
     */
    private $bovin;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getObservation(): ?string
    {
        return $this->observation;
    }

    public function setObservation(string $observation): self
    {
        $this->observation = $observation;

        return $this;
    }

    public function getDateConsultation(): ?\DateTimeInterface
    {
        return $this->date_consultation;
    }

    public function setDateConsultation(\DateTimeInterface $date_consultation): self
    {
        $this->date_consultation = $date_consultation;

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
