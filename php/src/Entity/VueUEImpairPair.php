<?php

namespace App\Entity;

use App\Repository\VueUEImpairPairRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VueUEImpairPairRepository::class)]
#[ORM\Table(name: "VueUEImpairPair")]
class VueUEImpairPair
{
    #[ORM\Id]
    #[ORM\Column(type: 'string', name: 'codeue')]
    private $codeUE;

    public function getCodeUE(): ?string
    {
        return $this->codeUE;
    }
}
