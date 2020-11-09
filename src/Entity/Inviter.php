<?php

namespace App\Entity;

use App\Repository\InviterRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=InviterRepository::class)
 */
class Inviter
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $specialisation;

    /**
     * @ORM\ManyToOne(targetEntity=Praticien::class, inversedBy="inviters")
     */
    private $praticien;

    /**
     * @ORM\ManyToOne(targetEntity=ActiviteComplet::class, inversedBy="inviters")
     */
    private $Activite_compl;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSpecialisation(): ?string
    {
        return $this->specialisation;
    }

    public function setSpecialisation(string $specialisation): self
    {
        $this->specialisation = $specialisation;

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

    public function getActiviteCompl(): ?ActiviteComplet
    {
        return $this->Activite_compl;
    }

    public function setActiviteCompl(?ActiviteComplet $Activite_compl): self
    {
        $this->Activite_compl = $Activite_compl;

        return $this;
    }
}
