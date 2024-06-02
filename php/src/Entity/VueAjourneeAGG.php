<?php

namespace App\Entity;

use App\Repository\VueAjourneeAGGRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VueAjourneeAGGRepository::class)]
#[ORM\Table(name: "VueAjourneeAGG")]
class VueAjourneeAGG
{
    #[ORM\Id]
    #[ORM\Column(type: 'string', name: 'uetotal')]
    private $uetotal;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $nbinscrit;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $annee;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $nbajournee;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private $ueechec;

    public function getUETotal(): ?string
    {
        return $this->uetotal;
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

    public function getNbajournee(): ?int
    {
        return $this->nbajournee;
    }

    public function setNbajournee(?int $nbajournee): self
    {
        $this->nbajournee = $nbajournee;

        return $this;
    }

    public function getUeechec(): ?string
    {
        return $this->ueechec;
    }

    public function setUeechec(?string $ueechec): self
    {
        $this->ueechec = $ueechec;

        return $this;
    }
}
