<?php

namespace App\Entity;

use App\Repository\EtudiantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EtudiantRepository::class)]
class Etudiant
{
    #[ORM\Id]
    #[ORM\Column(type: 'string', length: 20)]
    private $ine;

    #[ORM\Column(type: 'string', length: 20)]
    private $nom;

    #[ORM\Column(type: 'string', length: 50)]
    private $prenom;

    #[ORM\Column(type: 'date')]
    private $date_de_naissance;

    #[ORM\ManyToMany(targetEntity: Semestre::class, inversedBy: 'etudiants')]
    #[ORM\JoinTable(name: "EtudiantSemestre")]
    #[ORM\JoinColumn(name: "ine", referencedColumnName: "ine")]
    #[ORM\InverseJoinColumn(name: "id", referencedColumnName: "id")]
    private $semestres;

    #[ORM\OneToMany(mappedBy: 'ineetudiant', targetEntity: UEValide::class)]
    private $ueValides;

    public function __construct()
    {
        $this->semestres = new ArrayCollection();
        $this->ueValides = new ArrayCollection();
    }

    public function getIne(): ?string
    {
        return $this->ine;
    }

    public function setIne(string $ine): self
    {
        $this->ine = $ine;

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

    public function getDateDeNaissance(): ?\DateTimeInterface
    {
        return $this->date_de_naissance;
    }

    public function setDateDeNaissance(\DateTimeInterface $date_de_naissance): self
    {
        $this->date_de_naissance = $date_de_naissance;

        return $this;
    }

    public function getECTS(): ?int
    {
        $nbECTS = 0;

        $semestres = $this->getSemestres()->toArray();

        // for ($semestre as $semestre) {

        // }
        return $nbECTS;
    }

    /**
     * @return Collection<int, Semestre>
     */
    public function getSemestres(): Collection
    {
        return $this->semestres;
    }

    public function addSemestre(Semestre $semestre): self
    {
        if (!$this->semestres->contains($semestre)) {
            $this->semestres[] = $semestre;
        }

        return $this;
    }

    public function removeSemestre(Semestre $semestre): self
    {
        $this->semestres->removeElement($semestre);

        return $this;
    }

    /**
     * @return Collection<int, UEValide>
     */
    public function getUeValides(): Collection
    {
        return $this->ueValides;
    }

    public function addUeValide(UEValide $ueValide): self
    {
        if (!$this->ueValides->contains($ueValide)) {
            $this->ueValides[] = $ueValide;
            $ueValide->setIneetudiant($this);
        }

        return $this;
    }

    public function removeUeValide(UEValide $ueValide): self
    {
        if ($this->ueValides->removeElement($ueValide)) {
            // set the owning side to null (unless already changed)
            if ($ueValide->getIneetudiant() === $this) {
                $ueValide->setIneetudiant(null);
            }
        }

        return $this;
    }
}
