<?php

namespace App\Entity;

use App\Repository\Vue2CesureRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: Vue2CesureRepository::class)]
#[ORM\Table(name: "vue2cesure")]
class Vue2Cesure
{
    #[ORM\Id]
    #[ORM\Column(type: 'string', name: 'nom')]
    private $nom;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private $prenom;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $anneecesure1;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $anneecesure2;

    public function getNom(): ?string
    {
        return $this->nom;
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

    public function getAnneecesure1(): ?int
    {
        return $this->anneecesure1;
    }

    public function setAnneecesure1(?int $anneecesure1): self
    {
        $this->anneecesure1 = $anneecesure1;

        return $this;
    }

    public function getAnneecesure2(): ?int
    {
        return $this->anneecesure2;
    }

    public function setAnneecesure2(?int $anneecesure2): self
    {
        $this->anneecesure2 = $anneecesure2;

        return $this;
    }
}
