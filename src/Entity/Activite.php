<?php

namespace App\Entity;

use App\Traits\TimeStampTrait;
use App\Repository\ActiviteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ActiviteRepository::class)]
#[ORM\HasLifecycleCallbacks()]

class Activite
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

    #[ORM\ManyToOne(targetEntity: SousAction::class, inversedBy: 'activites')]
    private $sousAction;

    #[ORM\OneToMany(mappedBy: 'activite', targetEntity: SousActivite::class)]
    private $sousActivites;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'activites')]
    private $createdBy;

    public function __construct()
    {
        $this->sousActivites = new ArrayCollection();
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

    public function getSousAction(): ?SousAction
    {
        return $this->sousAction;
    }

    public function setSousAction(?SousAction $sousAction): self
    {
        $this->sousAction = $sousAction;

        return $this;
    }

    /**
     * @return Collection<int, SousActivite>
     */
    public function getSousActivites(): Collection
    {
        return $this->sousActivites;
    }

    public function addSousActivite(SousActivite $sousActivite): self
    {
        if (!$this->sousActivites->contains($sousActivite)) {
            $this->sousActivites[] = $sousActivite;
            $sousActivite->setActivite($this);
        }

        return $this;
    }

    public function removeSousActivite(SousActivite $sousActivite): self
    {
        if ($this->sousActivites->removeElement($sousActivite)) {
            // set the owning side to null (unless already changed)
            if ($sousActivite->getActivite() === $this) {
                $sousActivite->setActivite(null);
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
