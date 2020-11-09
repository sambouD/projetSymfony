<?php

namespace App\Entity;

use App\Repository\VisiteurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VisiteurRepository::class)
 */
class Visiteur
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity=RapportVisite::class, mappedBy="visiteur")
     */
    private $rapport_visite;

    /**
     * @ORM\ManyToMany(targetEntity=ActiviteComplet::class, mappedBy="visiteur")
     */
    private $activiteComplets;

    public function __construct()
    {
        $this->rapport_visite = new ArrayCollection();
        $this->activiteComplets = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|RapportVisite[]
     */
    public function getRapportVisite(): Collection
    {
        return $this->rapport_visite;
    }

    public function addRapportVisite(RapportVisite $rapportVisite): self
    {
        if (!$this->rapport_visite->contains($rapportVisite)) {
            $this->rapport_visite[] = $rapportVisite;
            $rapportVisite->setVisiteur($this);
        }

        return $this;
    }

    public function removeRapportVisite(RapportVisite $rapportVisite): self
    {
        if ($this->rapport_visite->removeElement($rapportVisite)) {
            // set the owning side to null (unless already changed)
            if ($rapportVisite->getVisiteur() === $this) {
                $rapportVisite->setVisiteur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ActiviteComplet[]
     */
    public function getActiviteComplets(): Collection
    {
        return $this->activiteComplets;
    }

    public function addActiviteComplet(ActiviteComplet $activiteComplet): self
    {
        if (!$this->activiteComplets->contains($activiteComplet)) {
            $this->activiteComplets[] = $activiteComplet;
            $activiteComplet->addVisiteur($this);
        }

        return $this;
    }

    public function removeActiviteComplet(ActiviteComplet $activiteComplet): self
    {
        if ($this->activiteComplets->removeElement($activiteComplet)) {
            $activiteComplet->removeVisiteur($this);
        }

        return $this;
    }
}
