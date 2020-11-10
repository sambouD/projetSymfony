<?php

namespace App\Entity;

use App\Repository\MedicamentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MedicamentRepository::class)
 */
class Medicament
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity=Offrir::class, mappedBy="medicament")
     */
    private $offrirs;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $libelle;

    public function __construct()
    {
        $this->offrirs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

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
            $offrir->setMedicament($this);
        }

        return $this;
    }

    public function removeOffrir(Offrir $offrir): self
    {
        if ($this->offrirs->removeElement($offrir)) {
            // set the owning side to null (unless already changed)
            if ($offrir->getMedicament() === $this) {
                $offrir->setMedicament(null);
            }
        }

        return $this;
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
}
