<?php

namespace App\Entity;

use App\Repository\UERepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UERepository::class)]
class UE
{
    #[ORM\Id]
    #[ORM\Column(type: 'string', length: 20)]
    private $code;

    #[ORM\Column(type: 'string', length: 3)]
    private $modalite;

    #[ORM\Column(type: 'string', length: 50)]
    private $libelle;

    #[ORM\ManyToOne(targetEntity: Responsable::class, inversedBy: 'ues')]
    #[ORM\JoinColumn(name: "responsable")]
    private $responsable;

    #[ORM\Column(type: 'integer')]
    #[Assert\Range(min: 0, max: 300)]
    private $capacite;

    #[ORM\ManyToMany(targetEntity: Module::class, inversedBy: 'ue')]
    #[ORM\JoinTable(name: "UEModule")]
    #[ORM\JoinColumn(name: "codeUE", referencedColumnName: "code")]
    #[ORM\InverseJoinColumn(name: "codeModule", referencedColumnName: "code")]
    private $modules;

    #[ORM\ManyToMany(targetEntity: Semestre::class, mappedBy: 'ues')]
    private $semestres;

    #[ORM\OneToMany(mappedBy: 'codeue', targetEntity: UEValide::class)]
    private $ueValides;

    public function __construct()
    {
        $this->modules = new ArrayCollection();
        $this->semestres = new ArrayCollection();
        $this->ueValides = new ArrayCollection();
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function getModalite(): ?string
    {
        return $this->modalite;
    }

    public function setModalite(string $modalite): self
    {
        $this->modalite = $modalite;

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

    public function getResponsable(): ?Responsable
    {
        return $this->responsable;
    }

    public function setResponsable(?Responsable $responsable): self
    {
        $this->responsable = $responsable;

        return $this;
    }

    public function getCapacite(): ?int
    {
        return $this->capacite;
    }

    public function setCapacite(int $capacite): self
    {
        $this->capacite = $capacite;

        return $this;
    }

    /**
     * @return Collection<int, Module>
     */
    public function getModules(): Collection
    {
        return $this->modules;
    }

    public function addModule(Module $module): self
    {
        if (!$this->modules->contains($module)) {
            $this->modules[] = $module;
            $module->addUe($this);
        }

        return $this;
    }

    public function removeModule(Module $module): self
    {
        if ($this->modules->removeElement($module)) {
            $module->removeUe($this);
        }

        return $this;
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
            $semestre->addUe($this);
        }

        return $this;
    }

    public function removeSemestre(Semestre $semestre): self
    {
        if ($this->semestres->removeElement($semestre)) {
            $semestre->removeUe($this);
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
            $ueValide->setCodeue($this);
        }

        return $this;
    }

    public function removeUeValide(UEValide $ueValide): self
    {
        if ($this->ueValides->removeElement($ueValide)) {
            // set the owning side to null (unless already changed)
            if ($ueValide->getCodeue() === $this) {
                $ueValide->setCodeue(null);
            }
        }

        return $this;
    }
}
