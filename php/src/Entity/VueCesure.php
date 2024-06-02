<?php

namespace App\Entity;

use App\Repository\VueCesureRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VueCesureRepository::class)]
#[ORM\Table(name: "vuecesure")]
class VueCesure
{
    #[ORM\Id]
    #[ORM\Column(type: 'string', name: 'ine')]
    private $ine;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $semestreid;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $annee;

    #[ORM\Column(type: 'string', length: 20, nullable: true)]
    private $nom;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private $prenom;

    public function getIne(): ?string
    {
        return $this->ine;
    }

    public function getSemestreid(): ?int
    {
        return $this->semestreid;
    }

    public function setSemestreid(?int $semestreid): self
    {
        $this->semestreid = $semestreid;

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

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(?string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }
}
