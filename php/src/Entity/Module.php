<?php

namespace App\Entity;

use App\Repository\ModuleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ModuleRepository::class)]
class Module
{
    #[ORM\Id]
    #[ORM\Column(type: 'string')]
    private $code;

    #[ORM\Column(type: 'string', length: 50)]
    private $libelle;

    #[ORM\Column(type: 'text', nullable: true)]
    private $commentaire;

    #[ORM\ManyToMany(targetEntity: UE::class, mappedBy: 'modules')]
    private $ue;

    public function __construct()
    {
        $this->ue = new ArrayCollection();
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(?string $commentaire): self
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    /**
     * @return Collection<int, UE>
     */
    public function getUe(): Collection
    {
        return $this->ue;
    }

    public function addUe(UE $ue): self
    {
        if (!$this->ue->contains($ue)) {
            $this->ue[] = $ue;
        }

        return $this;
    }

    public function removeUe(UE $ue): self
    {
        $this->ue->removeElement($ue);

        return $this;
    }
}
