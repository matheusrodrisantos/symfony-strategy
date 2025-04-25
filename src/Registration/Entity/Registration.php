<?php

namespace App\Registration\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity()]
class Registration
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    // TODO: Adicionar outras propriedades

    public function getId(): ?int
    {
        return $this->id;
    }
}