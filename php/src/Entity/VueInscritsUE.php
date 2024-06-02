<?php

namespace App\Entity;

use App\Repository\VueInscritsUERepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VueInscritsUERepository::class)]
#[ORM\Table(name: "VueInscritsUE")]
class VueInscritsUE
{
    #[ORM\Id]
    #[ORM\Column(type: 'string', name: 'nomue')]
    private $nomue;

    #[ORM\Column(type: 'string', length: 20, nullable: true)]
    private $nom_etudiant;

    #[ORM\Column(type: 'string', length: 20, nullable: true)]
    private $prenom_etudiant;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $annee;

    public function getNomue(): ?string
    {
        return $this->nomue;
    }

    public function getNomEtudiant(): ?string
    {
        return $this->nom_etudiant;
    }

    public function setNomEtudiant(?string $nom_etudiant): self
    {
        $this->nom_etudiant = $nom_etudiant;

        return $this;
    }

    public function getPrenomEtudiant(): ?string
    {
        return $this->prenom_etudiant;
    }

    public function setPrenomEtudiant(?string $prenom_etudiant): self
    {
        $this->prenom_etudiant = $prenom_etudiant;

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
