<?php

namespace App\Entity;

use App\Traits\TimeStampTrait;
use App\Repository\FonctionUniteFonctionnelleRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: FonctionUniteFonctionnelleRepository::class)]
#[ORM\HasLifecycleCallbacks()]

class FonctionUniteFonctionnelle
{
    use TimeStampTrait;
    
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $libelle;

    #[ORM\Column(type: 'text', nullable: true)]
    private $description;

    public function __construct()
    {
   
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }
    public function __toString()
    {
        return $this->libelle;
    }


}
