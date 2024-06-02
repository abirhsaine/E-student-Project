<?php

namespace App\Entity;

use App\Repository\VueInscritsUniteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VueInscritsUniteRepository::class)]
#[ORM\Table(name: "VueInscritsUnite")]
class VueInscritsUnite
{
    #[ORM\Id]
    #[ORM\Column(type: 'string', name: 'codeue')]
    private $codeue;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $nbinscrit;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $annee;

    public function getCodeue(): ?string
    {
        return $this->codeue;
    }

    public function getNbinscrit(): ?int
    {
        return $this->nbinscrit;
    }

    public function setNbinscrit(?int $nbinscrit): self
    {
        $this->nbinscrit = $nbinscrit;

        return $this;
    }

    public function getAnnee(): ?int
    {
        return $this->annee;
    }

    public function setAnnee(?int $annee): self
    {
        $this->annee = $annee;

        return $this;
    }
}
