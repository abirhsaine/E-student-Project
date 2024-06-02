<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\VueModulePairRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VueModulePairRepository::class)]
#[ORM\Table(name: "VueModulePair")]
#[ApiResource]
class VueModulePair
{
    #[ORM\Id]
    #[ORM\Column(type: 'string', name: 'codedumodule')]
    private $codeModule;

    public function getCodeModule(): ?string
    {
        return $this->codeModule;
    }
}
