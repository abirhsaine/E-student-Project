<?php

namespace App\Entity;

use App\Repository\SemestreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SemestreRepository::class)]
class Semestre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 20)]
    private $type;

    #[ORM\Column(type: 'boolean')]
    private $pair;

    #[ORM\Column(type: 'integer')]
    private $annee;

    #[ORM\ManyToOne(targetEntity: ParcoursType::class, inversedBy: 'semestres')]
    #[ORM\JoinColumn(name: "parcours_type")]
    private $parcours_type;

    #[ORM\ManyToMany(targetEntity: UE::class, inversedBy: 'semestres')]
    #[ORM\JoinTable(name: "UESemestre")]
    #[ORM\JoinColumn(name: "id", referencedColumnName: "id")]
    #[ORM\InverseJoinColumn(name: "code", referencedColumnName: "code")]
    private $ues;

    #[ORM\ManyToMany(targetEntity: Etudiant::class, mappedBy: 'semestres')]
    private $etudiants;

    #[ORM\OneToMany(mappedBy: 'idsemestre', targetEntity: UEValide::class)]
    private $ueValides;

    public function __construct()
    {
        $this->ues = new ArrayCollection();
        $this->etudiants = new ArrayCollection();
        $this->ueValides = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getPair(): ?bool
    {
        return $this->pair;
    }

    public function setPair(bool $pair): self
    {
        $this->pair = $pair;

        return $this;
    }

    public function getAnnee(): ?int
    {
        return $this->annee;
    }

    public function setAnnee(int $annee): self
    {
        $this->annee = $annee;

        return $this;
    }

    public function getParcoursType(): ?ParcoursType
    {
        return $this->parcours_type;
    }

    public function setParcoursType(?ParcoursType $parcours_type): self
    {
        $this->parcours_type = $parcours_type;

        return $this;
    }

    /**
     * @return Collection<int, UE>
     */
    public function getUes(): Collection
    {
        return $this->ues;
    }

    public function addUe(UE $ue): self
    {
        if (!$this->ues->contains($ue)) {
            $this->ues[] = $ue;
        }

        return $this;
    }

    public function removeUe(UE $ue): self
    {
        $this->ues->removeElement($ue);

        return $this;
    }

    public function clearUE(): self
    {
        $this->ues->clear();

        return $this;
    }

    /**
     * @return Collection<int, Etudiant>
     */
    public function getEtudiants(): Collection
    {
        return $this->etudiants;
    }

    public function addEtudiant(Etudiant $etudiant): self
    {
        if (!$this->etudiants->contains($etudiant)) {
            $this->etudiants[] = $etudiant;
            $etudiant->addSemestre($this);
        }

        return $this;
    }

    public function removeEtudiant(Etudiant $etudiant): self
    {
        if ($this->etudiants->removeElement($etudiant)) {
            $etudiant->removeSemestre($this);
        }

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
            $ueValide->setIdsemestre($this);
        }

        return $this;
    }

    public function removeUeValide(UEValide $ueValide): self
    {
        if ($this->ueValides->removeElement($ueValide)) {
            // set the owning side to null (unless already changed)
            if ($ueValide->getIdsemestre() === $this) {
                $ueValide->setIdsemestre(null);
            }
        }

        return $this;
    }
}
