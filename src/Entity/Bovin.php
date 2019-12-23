<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BovinRepository")
 * @UniqueEntity("numero_ordre")
 */
class Bovin
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $numero_ordre;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $sexe;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_naissance;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Categorie", inversedBy="bovins")
     */
    private $categories;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Traitement", mappedBy="bovin")
     */
    private $traitemnts;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\FicheMedicale", mappedBy="bovin")
     */
    private $fichemedical;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Race", inversedBy="bovins")
     */
    private $races;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Type", inversedBy="bovins")
     */
    private $types;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Production", mappedBy="bovin")
     */
    private $production;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Lait", mappedBy="bovin")
     */
    private $laits;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Bovin", inversedBy="bovins")
     */
    private $bovin;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Bovin", mappedBy="bovin")
     */
    private $bovins;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Vente", mappedBy="bovins")
     */
    private $ventes;

    public function __construct()
    {
        $this->traitemnts = new ArrayCollection();
        $this->fichemedical = new ArrayCollection();
        $this->production = new ArrayCollection();
        $this->laits = new ArrayCollection();
        $this->bovins = new ArrayCollection();
        $this->ventes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumeroOrdre(): ?string
    {
        return $this->numero_ordre;
    }

    public function setNumeroOrdre(string $numero_ordre): self
    {
        $this->numero_ordre = $numero_ordre;

        return $this;
    }

    public function getSexe(): ?string
    {
        return $this->sexe;
    }

    public function setSexe(string $sexe): self
    {
        $this->sexe = $sexe;

        return $this;
    }

    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->date_naissance;
    }

    public function setDateNaissance(\DateTimeInterface $date_naissance): self
    {
        $this->date_naissance = $date_naissance;

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
     * @return Collection|Traitement[]
     */
    public function getTraitemnts(): Collection
    {
        return $this->traitemnts;
    }

    public function addTraitemnt(Traitement $traitemnt): self
    {
        if (!$this->traitemnts->contains($traitemnt)) {
            $this->traitemnts[] = $traitemnt;
            $traitemnt->setBovin($this);
        }

        return $this;
    }

    public function removeTraitemnt(Traitement $traitemnt): self
    {
        if ($this->traitemnts->contains($traitemnt)) {
            $this->traitemnts->removeElement($traitemnt);
            // set the owning side to null (unless already changed)
            if ($traitemnt->getBovin() === $this) {
                $traitemnt->setBovin(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|FicheMedicale[]
     */
    public function getFichemedical(): Collection
    {
        return $this->fichemedical;
    }

    public function addFichemedical(FicheMedicale $fichemedical): self
    {
        if (!$this->fichemedical->contains($fichemedical)) {
            $this->fichemedical[] = $fichemedical;
            $fichemedical->setBovin($this);
        }

        return $this;
    }

    public function removeFichemedical(FicheMedicale $fichemedical): self
    {
        if ($this->fichemedical->contains($fichemedical)) {
            $this->fichemedical->removeElement($fichemedical);
            // set the owning side to null (unless already changed)
            if ($fichemedical->getBovin() === $this) {
                $fichemedical->setBovin(null);
            }
        }

        return $this;
    }

    public function getRaces(): ?Race
    {
        return $this->races;
    }

    public function setRaces(?Race $races): self
    {
        $this->races = $races;

        return $this;
    }

    public function getTypes(): ?Type
    {
        return $this->types;
    }

    public function setTypes(?Type $types): self
    {
        $this->types = $types;

        return $this;
    }

    /**
     * @return Collection|Production[]
     */
    public function getProduction(): Collection
    {
        return $this->production;
    }

    public function addProduction(Production $production): self
    {
        if (!$this->production->contains($production)) {
            $this->production[] = $production;
            $production->setBovin($this);
        }

        return $this;
    }

    public function removeProduction(Production $production): self
    {
        if ($this->production->contains($production)) {
            $this->production->removeElement($production);
            // set the owning side to null (unless already changed)
            if ($production->getBovin() === $this) {
                $production->setBovin(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Lait[]
     */
    public function getLaits(): Collection
    {
        return $this->laits;
    }

    public function addLait(Lait $lait): self
    {
        if (!$this->laits->contains($lait)) {
            $this->laits[] = $lait;
            $lait->setBovin($this);
        }

        return $this;
    }

    public function removeLait(Lait $lait): self
    {
        if ($this->laits->contains($lait)) {
            $this->laits->removeElement($lait);
            // set the owning side to null (unless already changed)
            if ($lait->getBovin() === $this) {
                $lait->setBovin(null);
            }
        }

        return $this;
    }

    public function getBovin(): ?self
    {
        return $this->bovin;
    }

    public function setBovin(?self $bovin): self
    {
        $this->bovin = $bovin;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getBovins(): Collection
    {
        return $this->bovins;
    }

    public function addBovin(self $bovin): self
    {
        if (!$this->bovins->contains($bovin)) {
            $this->bovins[] = $bovin;
            $bovin->setBovin($this);
        }

        return $this;
    }

    public function removeBovin(self $bovin): self
    {
        if ($this->bovins->contains($bovin)) {
            $this->bovins->removeElement($bovin);
            // set the owning side to null (unless already changed)
            if ($bovin->getBovin() === $this) {
                $bovin->setBovin(null);
            }
        }

        return $this;
    }

     public function __toString()
    {
        return (string)$this->numero_ordre;
    }

     /**
      * @return Collection|Vente[]
      */
     public function getVentes(): Collection
     {
         return $this->ventes;
     }

     public function addVente(Vente $vente): self
     {
         if (!$this->ventes->contains($vente)) {
             $this->ventes[] = $vente;
             $vente->setBovins($this);
         }

         return $this;
     }

     public function removeVente(Vente $vente): self
     {
         if ($this->ventes->contains($vente)) {
             $this->ventes->removeElement($vente);
             // set the owning side to null (unless already changed)
             if ($vente->getBovins() === $this) {
                 $vente->setBovins(null);
             }
         }

         return $this;
     }
 
}
