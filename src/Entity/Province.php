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

    #[ORM\OneToMany(mappedBy: 'province', targetEntity: ZoneDeSante::class)]
    private $no;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'provinces')]
    private $createdBy;

    #[ORM\ManyToMany(targetEntity: Niveau::class, mappedBy: 'province')]
    private $niveaux;

    public function __construct()
    {
        $this->no = new ArrayCollection();
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
    public function __toString()
    {
        return $this->libelle;
    }

    /**
     * @return Collection<int, ZoneDeSante>
     */
    public function getNo(): Collection
    {
        return $this->no;
    }

    public function addNo(ZoneDeSante $no): self
    {
        if (!$this->no->contains($no)) {
            $this->no[] = $no;
            $no->setProvince($this);
        }

        return $this;
    }

    public function removeNo(ZoneDeSante $no): self
    {
        if ($this->no->removeElement($no)) {
            // set the owning side to null (unless already changed)
            if ($no->getProvince() === $this) {
                $no->setProvince(null);
            }
        }

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

}
