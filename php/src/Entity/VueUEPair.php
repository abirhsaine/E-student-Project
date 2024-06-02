<?php

namespace App\Entity;

use App\Repository\VueUEPairRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VueUEPairRepository::class)]
#[ORM\Table(name: "VueUEPair")]
class VueUEPair
{
    #[ORM\Id]
    #[ORM\Column(type: 'string', name: 'codeue')]
    private $codeUE;

    public function getCodeUE(): ?string
    {
        return $this->codeUE;
    }
}
