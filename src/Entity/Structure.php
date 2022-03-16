<?php

namespace App\Entity;

use App\Traits\TimeStampTrait;
use App\Repository\StructureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StructureRepository::class)]
#[ORM\HasLifecycleCallbacks()]

class Structure
{
    use TimeStampTrait;
    
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $typeDeStructure;

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'structures')]
    private $StructureDeReference;

    #[ORM\OneToMany(mappedBy: 'StructureDeReference', targetEntity: self::class)]
    private $structures;

    #[ORM\ManyToOne(targetEntity: Categorie::class, inversedBy: 'structures')]
    private $categorie;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'structures')]
    #[ORM\JoinColumn(nullable: false)]
    private $createdBy;

    #[ORM\Column(type: 'string', length: 255)]
    private $libelle;

    #[ORM\Column(type: 'string', length: 255)]
    private $description;

    public function __construct()
    {
        $this->structures = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }
    public function __toString()
    {
        return $this->libelle;
    }

    public function getTypeDeStructure(): ?string
    {
        return $this->typeDeStructure;
    }

    public function setTypeDeStructure(?string $typeDeStructure): self
    {
        $this->typeDeStructure = $typeDeStructure;

        return $this;
    }

    public function getStructureDeReference(): ?self
    {
        return $this->StructureDeReference;
    }

    public function setStructureDeReference(?self $StructureDeReference): self
    {
        $this->StructureDeReference = $StructureDeReference;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getStructures(): Collection
    {
        return $this->structures;
    }

    public function addStructure(self $structure): self
    {
        if (!$this->structures->contains($structure)) {
            $this->structures[] = $structure;
            $structure->setStructureDeReference($this);
        }

        return $this;
    }

    public function removeStructure(self $structure): self
    {
        if ($this->structures->removeElement($structure)) {
            // set the owning side to null (unless already changed)
            if ($structure->getStructureDeReference() === $this) {
                $structure->setStructureDeReference(null);
            }
        }

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

    public function getCreatedBy(): ?User
    {
        return $this->createdBy;
    }

    public function setCreatedBy(?User $createdBy): self
    {
        $this->createdBy = $createdBy;

        return $this;
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
}
