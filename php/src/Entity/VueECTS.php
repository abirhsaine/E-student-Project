<?php

namespace App\Entity;

use App\Repository\VueECTSRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VueECTSRepository::class)]
#[ORM\Table(name: "vueects")]
class VueECTS
{
    #[ORM\Id]
    #[ORM\Column(type: 'string', name: 'ine')]
    private $ine;

    #[ORM\Column(type: 'string', length: 20, nullable: true)]
    private $nom;

    #[ORM\Column(type: 'string', length: 20, nullable: true)]
    private $prenom;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $annee;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $nbects;

    public function getIne(): ?string
    {
        return $this->ine;
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

    public function getAnnee(): ?int
    {
        return $this->annee;
    }

    public function setAnnee(?int $annee): self
    {
        $this->annee = $annee;

        return $this;
    }

    public function getNbects(): ?int
    {
        return $this->nbects;
    }

    public function setNbects(?int $nbects): self
    {
        $this->nbects = $nbects;

        return $this;
    }
}
