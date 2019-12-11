<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TypeRepository")
 */
class Type
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
    private $type;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Bovin", mappedBy="types")
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

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

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
            $bovin->setTypes($this);
        }

        return $this;
    }

    public function removeBovin(Bovin $bovin): self
    {
        if ($this->bovins->contains($bovin)) {
            $this->bovins->removeElement($bovin);
            // set the owning side to null (unless already changed)
            if ($bovin->getTypes() === $this) {
                $bovin->setTypes(null);
            }
        }

        return $this;
    }

     public function __toString()
    {
        return (string)$this->type;
    }
}
