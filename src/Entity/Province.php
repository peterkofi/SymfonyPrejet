<?php

namespace App\Entity;

use App\Traits\TimeStampTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ProvinceRepository;

#[ORM\Entity(repositoryClass: ProvinceRepository::class)]
#[ORM\HasLifecycleCallbacks()]

class Province
{
    use TimeStampTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 50)]
    private $libelle;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'provinces')]
    private $createdBy;

    #[ORM\ManyToMany(targetEntity: Niveau::class, mappedBy: 'province')]
    private $niveaux;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $chefLieu;


    public function __construct()
    {
        $this->niveaux = new ArrayCollection();
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

    public function getCreatedBy(): ?User
    {
        return $this->createdBy;
    }

    public function setCreatedBy(?User $createdBy): self
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    /**
     * @return Collection<int, Niveau>
     */
    public function getNiveaux(): Collection
    {
        return $this->niveaux;
    }

    public function addNiveau(Niveau $niveau): self
    {
        if (!$this->niveaux->contains($niveau)) {
            $this->niveaux[] = $niveau;
            $niveau->addProvince($this);
        }

        return $this;
    }

    public function removeNiveau(Niveau $niveau): self
    {
        if ($this->niveaux->removeElement($niveau)) {
            $niveau->removeProvince($this);
        }

        return $this;
    }

    public function __toString()
    {
        return $this->libelle;
    }

    public function getChefLieu(): ?string
    {
        return $this->chefLieu;
    }

    public function setChefLieu(?string $chefLieu): self
    {
        $this->chefLieu = $chefLieu;

        return $this;
    }

}
