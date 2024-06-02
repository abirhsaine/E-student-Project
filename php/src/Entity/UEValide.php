<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\UEValideRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UEValideRepository::class)]
#[ApiResource]
class UEValide
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: Etudiant::class, inversedBy: 'ueValides')]
    #[ORM\JoinColumn(name: "ineEtudiant", referencedColumnName: "ine")]
    private $ineetudiant;

    #[ORM\ManyToOne(targetEntity: Semestre::class, inversedBy: 'ueValides')]
    #[ORM\JoinColumn(name: "id", referencedColumnName: "id")]
    private $idsemestre;

    #[ORM\ManyToOne(targetEntity: UE::class, inversedBy: 'ueValides')]
    #[ORM\JoinColumn(name: "codeUE", referencedColumnName: "code")]
    private $codeue;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $valide;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIneetudiant(): ?Etudiant
    {
        return $this->ineetudiant;
    }

    public function setIneetudiant(?Etudiant $ineetudiant): self
    {
        $this->ineetudiant = $ineetudiant;

        return $this;
    }

    public function getIdsemestre(): ?Semestre
    {
        return $this->idsemestre;
    }

    public function setIdsemestre(?Semestre $idsemestre): self
    {
        $this->idsemestre = $idsemestre;

        return $this;
    }

    public function getCodeue(): ?UE
    {
        return $this->codeue;
    }

    public function setCodeue(?UE $codeue): self
    {
        $this->codeue = $codeue;

        return $this;
    }

    public function getValide(): ?bool
    {
        return $this->valide;
    }

    public function setValide(?bool $valide): self
    {
        $this->valide = $valide;

        return $this;
    }
}
