<?php

namespace App\Entity;

use App\Traits\TimeStampTrait;
use App\Repository\ActionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ActionRepository::class)]
#[ORM\HasLifecycleCallbacks()]
class Action
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

    #[ORM\ManyToOne(targetEntity: Planification::class, inversedBy: 'actions')]
    private $planification;

    #[ORM\OneToMany(mappedBy: 'action', targetEntity: SousAction::class)]
    private $sousActions;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'actions')]
    private $createdBy;

    public function __construct()
    {
        $this->sousActions = new ArrayCollection();
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

    public function getPlanification(): ?Planification
    {
        return $this->planification;
    }

    public function setPlanification(?Planification $planification): self
    {
        $this->planification = $planification;

        return $this;
    }

    /**
     * @return Collection<int, SousAction>
     */
    public function getSousActions(): Collection
    {
        return $this->sousActions;
    }

    public function addSousAction(SousAction $sousAction): self
    {
        if (!$this->sousActions->contains($sousAction)) {
            $this->sousActions[] = $sousAction;
            $sousAction->setAction($this);
        }

        return $this;
    }

    public function removeSousAction(SousAction $sousAction): self
    {
        if ($this->sousActions->removeElement($sousAction)) {
            // set the owning side to null (unless already changed)
            if ($sousAction->getAction() === $this) {
                $sousAction->setAction(null);
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
