<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\OffrirRepository;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=OffrirRepository::class)
 */
class Offrir
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $off_qte;

    /**
     * @ORM\ManyToOne(targetEntity=Medicament::class, inversedBy="offrirs")
     * @ORM\JoinColumn(nullable=false)
     * 
     */
    private $medicament;

    /**
     * @ORM\ManyToOne(targetEntity=RapportVisite::class, inversedBy="offrirs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $rapport_visite;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOffQte(): ?int
    {
        return $this->off_qte;
    }

    public function setOffQte(?int $off_qte): self
    {
        $this->off_qte = $off_qte;

        return $this;
    }

    public function getMedicament(): ?Medicament
    {
        return $this->medicament;
    }

    public function setMedicament(?Medicament $medicament): self
    {
        $this->medicament = $medicament;

        return $this;
    }


   




    public function getRapportVisite(): ?RapportVisite
    {
        return $this->rapport_visite;
    }

    public function setRapportVisite(?RapportVisite $rapport_visite): self
    {
        $this->rapport_visite = $rapport_visite;

        return $this;
    }

}
