<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductionRepository")
 */
class Production
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
    private $nbre_mise_bas;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbre_veau;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbre_vivant;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbre_mort;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=0)
     */
    private $taux_production;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=0)
     */
    private $taux_mortalite;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_production;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Bovin", inversedBy="production")
     */
    private $bovin;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNbreMiseBas(): ?int
    {
        return $this->nbre_mise_bas;
    }

    public function setNbreMiseBas(int $nbre_mise_bas): self
    {
        $this->nbre_mise_bas = $nbre_mise_bas;

        return $this;
    }

    public function getNbreVeau(): ?int
    {
        return $this->nbre_veau;
    }

    public function setNbreVeau(int $nbre_veau): self
    {
        $this->nbre_veau = $nbre_veau;

        return $this;
    }

    public function getNbreVivant(): ?int
    {
        return $this->nbre_vivant;
    }

    public function setNbreVivant(int $nbre_vivant): self
    {
        $this->nbre_vivant = $nbre_vivant;

        return $this;
    }

    public function getNbreMort(): ?int
    {
        return $this->nbre_mort;
    }

    public function setNbreMort(int $nbre_mort): self
    {
        $this->nbre_mort = $nbre_mort;

        return $this;
    }

    public function getTauxProduction(): ?string
    {
        return $this->taux_production;
    }

    public function setTauxProduction(string $taux_production): self
    {
        $this->taux_production = $taux_production;

        return $this;
    }

    public function getTauxMortalite(): ?string
    {
        return $this->taux_mortalite;
    }

    public function setTauxMortalite(string $taux_mortalite): self
    {
        $this->taux_mortalite = $taux_mortalite;

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
}
