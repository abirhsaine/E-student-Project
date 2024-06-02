<?php

namespace App\Entity;

use App\Repository\ResponsableRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ResponsableRepository::class)]
class Responsable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 20)]
    private $nom;

    #[ORM\Column(type: 'string', length: 20)]
    private $prenom;

    #[ORM\OneToMany(mappedBy: 'responsable', targetEntity: UE::class)]
    private $ues;

    public function __construct()
    {
        $this->ues = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * @return Collection<int, UE>
     */
    public function getUes(): Collection
    {
        return $this->ues;
    }

    public function addUe(UE $ue): self
    {
        if (!$this->ues->contains($ue)) {
            $this->ues[] = $ue;
            $ue->setResponsable($this);
        }

        return $this;
    }

    public function removeUe(UE $ue): self
    {
        if ($this->ues->removeElement($ue)) {
            // set the owning side to null (unless already changed)
            if ($ue->getResponsable() === $this) {
                $ue->setResponsable(null);
            }
        }

        return $this;
    }
}
