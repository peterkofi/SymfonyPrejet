<?php

namespace App\Entity;

use App\Repository\ProgrammeRepository;
use App\Traits\TimeStampTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ProgrammeRepository::class)]
#[ORM\HasLifecycleCallbacks()]

class Programme
{
    use TimeStampTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 50)]
    #[Assert\NotBlank(message:'veillez remplir ce champ')]

    private $libelle;

    #[ORM\Column(type: 'text')]
    private $description;

    #[ORM\OneToMany(mappedBy: 'programme', targetEntity: UniteFonctionnelle::class)]
    private $uniteFonctionnelles;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'programmes')]
    private $createdBy;

    #[ORM\OneToMany(mappedBy: 'programme', targetEntity: Planification::class)]
    private $planification;

    public function __construct()
    {
        $this->uniteFonctionnelles = new ArrayCollection();
        $this->planification = new ArrayCollection();
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

    public function __toString()
    {
        return $this->libelle;
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
            $uniteFonctionnelle->setProgramme($this);
        }

        return $this;
    }

    public function removeUniteFonctionnelle(UniteFonctionnelle $uniteFonctionnelle): self
    {
        if ($this->uniteFonctionnelles->removeElement($uniteFonctionnelle)) {
            // set the owning side to null (unless already changed)
            if ($uniteFonctionnelle->getProgramme() === $this) {
                $uniteFonctionnelle->setProgramme(null);
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

    public function addPlanification(Planification $plan): self
    {
        if (!$this->planification->contains($plan)) {
            $this->planification[] = $plan;
            $plan->setProgramme($this);
        }

        return $this;
    }

    public function removePlanification(Planification $plan): self
    {
        if ($this->planification->removeElement($plan)) {
            // set the owning side to null (unless already changed)
            if ($plan->getProgramme() === $this) {
                $plan->setProgramme(null);
            }
        }

        return $this;
    }

  

}
