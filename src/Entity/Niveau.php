<?php

namespace App\Entity;

use App\Traits\TimeStampTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\NiveauRepository;

#[ORM\Entity(repositoryClass: NiveauRepository::class)]
#[ORM\HasLifecycleCallbacks()]

class Niveau
{
    use TimeStampTrait;
    
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 50)]
    private $libelle;

    #[ORM\Column(type: 'text')]
    private $description;

    #[ORM\ManyToOne(targetEntity: Categorie::class, inversedBy: 'niveau')]
    private $categorie;

    #[ORM\ManyToMany(targetEntity: Province::class, inversedBy: 'niveaux')]
    private $province;

    public function __construct()
    {
        $this->province = new ArrayCollection();
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

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

  

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }
    public function __toString()
    {
        return $this->libelle;
    }

    /**
     * @return Collection<int, Province>
     */
    public function getProvince(): Collection
    {
        return $this->province;
    }

    public function addProvince(Province $province): self
    {
        if (!$this->province->contains($province)) {
            $this->province[] = $province;
        }

        return $this;
    }

    public function removeProvince(Province $province): self
    {
        $this->province->removeElement($province);

        return $this;
    }

}
