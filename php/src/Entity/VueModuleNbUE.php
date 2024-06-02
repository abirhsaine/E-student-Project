<?php

namespace App\Entity;

use App\Repository\VueModuleNbUERepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VueModuleNbUERepository::class)]
#[ORM\Table(name: "VueModuleNbUE")]
class VueModuleNbUE
{
    #[ORM\Id]
    #[ORM\Column(type: 'string', name: 'codemodule')]
    private $codeModule;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $count;

    public function getCodeModule(): ?string
    {
        return $this->codeModule;
    }

    public function getCount(): ?int
    {
        return $this->count;
    }

    public function setCount(?int $count): self
    {
        $this->count = $count;

        return $this;
    }
}
