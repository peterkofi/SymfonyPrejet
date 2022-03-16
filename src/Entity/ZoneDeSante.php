<?php

namespace App\Entity;

use App\Traits\TimeStampTrait;
use App\Repository\ZoneDeSanteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ZoneDeSanteRepository::class)]
#[ORM\HasLifecycleCallbacks()]

class ZoneDeSante
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

    #[ORM\ManyToOne(targetEntity: Ville::class, inversedBy: 'zoneDeSantes')]
    private $ville;

    #[ORM\OneToMany(mappedBy: 'zoneDeSante', targetEntity: UniteFonctionnelle::class)]
    private $unitefonctionnelle;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'zoneDeSantes')]
    private $createdBy;

    public function __construct()
    {
        $this->unitefonctionnelle = new ArrayCollection();
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

    public function getVille(): ?Ville
    {
        return $this->ville;
    }

    public function setVille(?Ville $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * @return Collection<int, UniteFonctionnelle>
     */
    public function getUnitefonctionnelle(): Collection
    {
        return $this->unitefonctionnelle;
    }

    public function addUnitefonctionnelle(UniteFonctionnelle $unitefonctionnelle): self
    {
        if (!$this->unitefonctionnelle->contains($unitefonctionnelle)) {
            $this->unitefonctionnelle[] = $unitefonctionnelle;
            $unitefonctionnelle->setZoneDeSante($this);
        }

        return $this;
    }

    public function removeUnitefonctionnelle(UniteFonctionnelle $unitefonctionnelle): self
    {
        if ($this->unitefonctionnelle->removeElement($unitefonctionnelle)) {
            // set the owning side to null (unless already changed)
            if ($unitefonctionnelle->getZoneDeSante() === $this) {
                $unitefonctionnelle->setZoneDeSante(null);
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
     public function __toString()
    {
        return $this->libelle;
    }

}
