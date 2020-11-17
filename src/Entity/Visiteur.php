<?php

namespace App\Entity;

use App\Repository\VisiteurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=VisiteurRepository::class)
 */
class Visiteur implements UserInterface
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

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $login;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $mdp;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $cp;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ville;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateEmbouche;

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

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(string $login): self
    {
        $this->login = $login;

        return $this;
    }

    public function getMdp(): ?string
    {
        return $this->mdp;
    }

    public function setMdp(string $mdp): self
    {
        $this->mdp = $mdp;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(?string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getCp(): ?string
    {
        return $this->cp;
    }

    public function setCp(?string $cp): self
    {
        $this->cp = $cp;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(?string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getDateEmbouche(): ?\DateTimeInterface
    {
        return $this->dateEmbouche;
    }

    public function setDateEmbouche(?\DateTimeInterface $dateEmbouche): self
    {
        $this->dateEmbouche = $dateEmbouche;

        return $this;
    }

    public function getRoles() {
        return ['ROLE_USER'];
    }

    public function getPassword()
    {
        return $this->mdp;
    }

    public function getSalt() {}

    public function getUsername()
    {
        return $this->email;
    }

    public function eraseCredentials() {}
}