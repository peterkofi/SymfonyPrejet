<?php

namespace App\Entity;

use App\Traits\TimeStampTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\UniteFonctionnelleRepository;

#[ORM\Entity(repositoryClass: UniteFonctionnelleRepository::class)]
#[ORM\HasLifecycleCallbacks()]

class UniteFonctionnelle
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


    //#[ORM\OneToOne(inversedBy: 'no', targetEntity: Programme::class, cascade: ['persist', 'remove'])]
    // #[ORM\JoinColumn(nullable: false)]
    // private $programme;

    #[ORM\ManyToOne(targetEntity: Categorie::class, inversedBy: 'uniteFonctionnelles')]
    #[ORM\JoinColumn(nullable: false)]
    private $Categorie;

    #[ORM\ManyToOne(targetEntity: Programme::class, inversedBy: 'uniteFonctionnelles')]
    #[ORM\JoinColumn(nullable: false)]
    private $programme;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'uniteFonctionnelles')]
    private $createdBy;

    #[ORM\ManyToOne(targetEntity: ZoneDeSante::class, inversedBy: 'unitefonctionnelle')]
    private $zoneDeSante;

    #[ORM\ManyToMany(targetEntity: TypeValidationUF::class, inversedBy: 'uniteFonctionnelles')]
    private $typeValidation;



    public function __construct()
    {
        $this->typeValidation = new ArrayCollection();
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


    // public function getProgramme(): ?Programme
    // {
    //     return $this->programme;
    // }

    // public function setProgramme(Programme $programme): self
    // {
    //     $this->programme = $programme;

    //     return $this;
    // }

    public function getCategorie(): ?Categorie
    {
        return $this->Categorie;
    }

    public function setCategorie(?Categorie $Categorie): self
    {
        $this->Categorie = $Categorie;

        return $this;
    }

    public function getProgramme(): ?Programme
    {
        return $this->programme;
    }

    public function setProgramme(?Programme $programme): self
    {
        $this->programme = $programme;

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

    public function getZoneDeSante(): ?ZoneDeSante
    {
        return $this->zoneDeSante;
    }

    public function setZoneDeSante(?ZoneDeSante $zoneDeSante): self
    {
        $this->zoneDeSante = $zoneDeSante;

        return $this;
    }

    /**
     * @return Collection<int, TypeValidationUF>
     */
    public function getTypeValidation(): Collection
    {
        return $this->typeValidation;
    }

    public function addTypeValidation(TypeValidationUF $typeValidation): self
    {
        if (!$this->typeValidation->contains($typeValidation)) {
            $this->typeValidation[] = $typeValidation;
        }

        return $this;
    }

    public function removeTypeValidation(TypeValidationUF $typeValidation): self
    {
        $this->typeValidation->removeElement($typeValidation);

        return $this;
    }
    
    public function __toString()
    {
        return $this->libelle;
    }



}
