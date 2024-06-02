<?php

namespace App\Entity;

use App\Repository\VueAcquisXRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VueAcquisXRepository::class)]
#[ORM\Table(name: "vueacquisx")]
class VueAcquisX
{
    #[ORM\Id]
    #[ORM\Column(type: 'string', name: 'ineetudiant')]
    private $ineetudiant;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $idsemestre;

    #[ORM\Column(type: 'string', length: 20, nullable: true)]
    private $codeue;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $valide;

    public function getIneetudiant(): ?string
    {
        return $this->ineetudiant;
    }

    public function getIdsemestre(): ?int
    {
        return $this->idsemestre;
    }

    public function setIdsemestre(?int $idsemestre): self
    {
        $this->idsemestre = $idsemestre;

        return $this;
    }

    public function getCodeue(): ?string
    {
        return $this->codeue;
    }

    public function setCodeue(?string $codeue): self
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
