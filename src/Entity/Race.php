<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RaceRepository")
 * @UniqueEntity("libelle")
 */
class Race
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
     * @ORM\Column(type="string",length=255)
     * @Assert\Image(mimeTypes="image/*" )
     *     
     */
    private $photo;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Bovin", mappedBy="races")
     */
    private $bovins;

    public function __construct()
    {
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

    public function getPhoto()
    {
        return $this->photo;
    }

    public function setPhoto($photo)
    {
        $this->photo = $photo;

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
            $bovin->setRaces($this);
        }

        return $this;
    }

    public function removeBovin(Bovin $bovin): self
    {
        if ($this->bovins->contains($bovin)) {
            $this->bovins->removeElement($bovin);
            // set the owning side to null (unless already changed)
            if ($bovin->getRaces() === $this) {
                $bovin->setRaces(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return (string)$this->libelle;
    }
}
