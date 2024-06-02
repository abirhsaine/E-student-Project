<?php

namespace App\Entity;

use App\Repository\VueUEImpairRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VueUEImpairRepository::class)]
#[ORM\Table(name: "VueUEImpair")]
class VueUEImpair
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'string', name: 'codeue')]
    private $codeUE;

    public function getCodeUE(): ?string
    {
        return $this->codeUE;
    }
}
