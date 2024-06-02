<?php

namespace App\Entity;

use App\Repository\VueDiplomesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VueDiplomesRepository::class)]
#[ORM\Table(name: "vuediplomes")]
class VueDiplomes
{
    #[ORM\Id]
    #[ORM\Column(type: 'string', name: 'nom_diplomee')]
    private $nom_diplomee;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private $prenom_diplomee;

    #[ORM\Column(type: 'date', nullable: true)]
    private $date_de_naissance;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $nbects;

    public function getNomDiplomee(): ?string
    {
        return $this->nom_diplomee;
    }

    public function getPrenomDiplomee(): ?string
    {
        return $this->prenom_diplomee;
    }

    public function setPrenomDiplomee(?string $prenom_diplomee): self
    {
        $this->prenom_diplomee = $prenom_diplomee;

        return $this;
    }

    public function getDateDeNaissance(): ?\DateTimeInterface
    {
        return $this->date_de_naissance;
    }

    public function setDateDeNaissance(?\DateTimeInterface $date_de_naissance): self
    {
        $this->date_de_naissance = $date_de_naissance;

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
