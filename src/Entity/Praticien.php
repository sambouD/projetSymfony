<?php

namespace App\Entity;

use App\Repository\PraticienRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PraticienRepository::class)
 */
class Praticien
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity=RapportVisite::class, mappedBy="praticien")
     */
    private $rapport_visite;

    /**
     * @ORM\OneToMany(targetEntity=Inviter::class, mappedBy="praticien")
     */
    private $inviters;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    public function __construct()
    {
        $this->rapport_visite = new ArrayCollection();
        $this->inviters = new ArrayCollection();
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
            $rapportVisite->setPraticien($this);
        }

        return $this;
    }

    public function removeRapportVisite(RapportVisite $rapportVisite): self
    {
        if ($this->rapport_visite->removeElement($rapportVisite)) {
            // set the owning side to null (unless already changed)
            if ($rapportVisite->getPraticien() === $this) {
                $rapportVisite->setPraticien(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Inviter[]
     */
    public function getInviters(): Collection
    {
        return $this->inviters;
    }

    public function addInviter(Inviter $inviter): self
    {
        if (!$this->inviters->contains($inviter)) {
            $this->inviters[] = $inviter;
            $inviter->setPraticien($this);
        }

        return $this;
    }

    public function removeInviter(Inviter $inviter): self
    {
        if ($this->inviters->removeElement($inviter)) {
            // set the owning side to null (unless already changed)
            if ($inviter->getPraticien() === $this) {
                $inviter->setPraticien(null);
            }
        }

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }
}
