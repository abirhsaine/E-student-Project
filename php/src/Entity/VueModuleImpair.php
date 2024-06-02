<?php

namespace App\Entity;

use App\Repository\VueModuleImpairRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VueModuleImpairRepository::class)]
#[ORM\Table(name: "VueModuleImpair")]
class VueModuleImpair
{
    #[ORM\Id]
    #[ORM\Column(type: 'string', name: 'codedumodule')]
    private $codeModule;

    public function getCodeModule(): ?string
    {
        return $this->codeModule;
    }
}
