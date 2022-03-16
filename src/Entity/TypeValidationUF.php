<?php

namespace App\Entity;

use App\Repository\TypeValidationUFRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TypeValidationUFRepository::class)]
class TypeValidationUF
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $typeDeValidation;

    #[ORM\ManyToMany(targetEntity: UniteFonctionnelle::class, mappedBy: 'typeValidation')]
    private $uniteFonctionnelles;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'typeValidationUFs')]
    private $createdBy;

    public function __construct()
    {
        $this->uniteFonctionnelles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypeDeValidation(): ?string
    {
        return $this->typeDeValidation;
    }

    public function setTypeDeValidation(string $typeDeValidation): self
    {
        $this->typeDeValidation = $typeDeValidation;

        return $this;
    }

    /**
     * @return Collection<int, UniteFonctionnelle>
     */
    public function getUniteFonctionnelles(): Collection
    {
        return $this->uniteFonctionnelles;
    }

    public function addUniteFonctionnelle(UniteFonctionnelle $uniteFonctionnelle): self
    {
        if (!$this->uniteFonctionnelles->contains($uniteFonctionnelle)) {
            $this->uniteFonctionnelles[] = $uniteFonctionnelle;
            $uniteFonctionnelle->addTypeValidation($this);
        }

        return $this;
    }

    public function removeUniteFonctionnelle(UniteFonctionnelle $uniteFonctionnelle): self
    {
        if ($this->uniteFonctionnelles->removeElement($uniteFonctionnelle)) {
            $uniteFonctionnelle->removeTypeValidation($this);
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
