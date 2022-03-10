<?php

namespace App\Entity;

use App\Repository\ConfigurationSystemRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ConfigurationSystemRepository::class)]
class ConfigurationSystem
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $taux;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTaux(): ?int
    {
        return $this->taux;
    }

    public function setTaux(?int $taux): self
    {
        $this->taux = $taux;

        return $this;
    }
}
