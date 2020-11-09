<?php

namespace App\Entity;

use App\Repository\ActiviteCompletRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ActiviteCompletRepository::class)
 */
class ActiviteComplet
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $ac_Date;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ac_lieu;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ac_theme;

    /**
     * @ORM\ManyToMany(targetEntity=Visiteur::class, inversedBy="activiteComplets")
     */
    private $visiteur;

    /**
     * @ORM\OneToMany(targetEntity=Inviter::class, mappedBy="Activite_compl")
     */
    private $inviters;

    public function __construct()
    {
        $this->visiteur = new ArrayCollection();
        $this->inviters = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAcDate(): ?\DateTimeInterface
    {
        return $this->ac_Date;
    }

    public function setAcDate(\DateTimeInterface $ac_Date): self
    {
        $this->ac_Date = $ac_Date;

        return $this;
    }

    public function getAcLieu(): ?string
    {
        return $this->ac_lieu;
    }

    public function setAcLieu(string $ac_lieu): self
    {
        $this->ac_lieu = $ac_lieu;

        return $this;
    }

    public function getAcTheme(): ?string
    {
        return $this->ac_theme;
    }

    public function setAcTheme(string $ac_theme): self
    {
        $this->ac_theme = $ac_theme;

        return $this;
    }

    /**
     * @return Collection|Visiteur[]
     */
    public function getVisiteur(): Collection
    {
        return $this->visiteur;
    }

    public function addVisiteur(Visiteur $visiteur): self
    {
        if (!$this->visiteur->contains($visiteur)) {
            $this->visiteur[] = $visiteur;
        }

        return $this;
    }

    public function removeVisiteur(Visiteur $visiteur): self
    {
        $this->visiteur->removeElement($visiteur);

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
            $inviter->setActiviteCompl($this);
        }

        return $this;
    }

    public function removeInviter(Inviter $inviter): self
    {
        if ($this->inviters->removeElement($inviter)) {
            // set the owning side to null (unless already changed)
            if ($inviter->getActiviteCompl() === $this) {
                $inviter->setActiviteCompl(null);
            }
        }

        return $this;
    }
}
