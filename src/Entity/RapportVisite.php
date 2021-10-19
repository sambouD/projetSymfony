<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\RapportVisiteRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=RapportVisiteRepository::class)
 * @UniqueEntity(
 * fields={"rap_bilan"},
 * message="Une autre rapport de visite possède déjâ ce bilan ! merci de le modifier"
 * )
 */
class RapportVisite
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     * 
     */
    private $rap_date;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min=20, minMessage="Votre bilan doit faire plus de 20 caractères")
     */
    private $rap_bilan;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message= "Veuillez entrer un motif , merci d'avance !")
     */
    private $rap_motif;

    /**
     * @ORM\OneToMany(targetEntity=Offrir::class, mappedBy="rapport_visite",  cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $offrirs;

    /**
     * @ORM\ManyToOne(targetEntity=Visiteur::class, inversedBy="rapport_visite")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotBlank(message= "Vous devez choisir un visiteur")
     */
    private $visiteur;

    /**
     * @ORM\ManyToOne(targetEntity=Praticien::class, inversedBy="rapport_visite")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotBlank(message= "Vous devez choisir un praticien")
     */
    private $praticien;

    /**
     * @ORM\ManyToOne(targetEntity=Motif::class, inversedBy="rapportVisites")
     */
    private $motif;

    /**
     * @ORM\ManyToOne(targetEntity=Lieux::class, inversedBy="rapportVisite")
     */
    private $lieux;

    public function __construct()
    {
        $this->offrirs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRapDate(): ?\DateTimeInterface
    {
        return $this->rap_date;
    }

    public function setRapDate(\DateTimeInterface $rap_date): self
    {
        $this->rap_date = $rap_date;

        return $this;
    }

    public function getRapBilan(): ?string
    {
        return $this->rap_bilan;
    }

    public function setRapBilan(string $rap_bilan): self
    {
        $this->rap_bilan = $rap_bilan;

        return $this;
    }

    public function getRapMotif(): ?string
    {
        return $this->rap_motif;
    }

    public function setRapMotif(string $rap_motif): self
    {
        $this->rap_motif = $rap_motif;

        return $this;
    }

    /**
     * @return Collection|Offrir[]
     */
    public function getOffrirs(): Collection
    {
        return $this->offrirs;
    }

    public function addOffrir(Offrir $offrir): self
    {
        if (!$this->offrirs->contains($offrir)) {
            $this->offrirs[] = $offrir;
            $offrir->setRapportVisite($this);
        }

        return $this;
    }

    public function removeOffrir(Offrir $offrir): self
    {
        if ($this->offrirs->removeElement($offrir)) {
            // set the owning side to null (unless already changed)
            if ($offrir->getRapportVisite() === $this) {
                $offrir->setRapportVisite(null);
            }
        }

        return $this;
    }

    public function getVisiteur(): ?Visiteur
    {
        return $this->visiteur;
    }

    public function setVisiteur(?Visiteur $visiteur): self
    {
        $this->visiteur = $visiteur;

        return $this;
    }

    public function getPraticien(): ?Praticien
    {
        return $this->praticien;
    }

    public function setPraticien(?Praticien $praticien): self
    {
        $this->praticien = $praticien;

        return $this;
    }

    public function getMotif(): ?Motif
    {
        return $this->motif;
    }

    public function setMotif(?Motif $motif): self
    {
        $this->motif = $motif;

        return $this;
    }

    public function getLieux(): ?Lieux
    {
        return $this->lieux;
    }

    public function setLieux(?Lieux $lieux): self
    {
        $this->lieux = $lieux;

        return $this;
    }

  


}
