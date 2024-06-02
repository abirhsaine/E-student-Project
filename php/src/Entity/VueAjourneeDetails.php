<?php

namespace App\Entity;

use App\Repository\VueAjourneeDetailsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VueAjourneeDetailsRepository::class)]
#[ORM\Table(name: "VueAjourneeDetails")]
class VueAjourneeDetails
{
    #[ORM\Id]
    #[ORM\Column(type: 'string', name: 'ue')]
    private $UE;

    #[ORM\Column(type: 'string', length: 20, nullable: true)]
    private $etudiant;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $annee;

    public function getUE(): ?string
    {
        return $this->UE;
    }

    public function getEtudiant(): ?string
    {
        return $this->etudiant;
    }

    public function setEtudiant(?string $etudiant): self
    {
        $this->etudiant = $etudiant;

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
