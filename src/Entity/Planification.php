<?php

namespace App\Entity;

use App\Traits\TimeStampTrait;
use App\Repository\PlanificationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: PlanificationRepository::class)]
#[ORM\HasLifecycleCallbacks()]

class Planification
{
    use TimeStampTrait;
    
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: Programme::class, inversedBy: 'Description')]
    #[Assert\NotBlank(message:'veillez remplir ce champ')]
    private $programme;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $description;

    #[ORM\OneToMany(mappedBy: 'planification', targetEntity: Action::class)]
    private $actions;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'planifications')]
    private $createdBy;


    public function __construct()
    {
        $this->actions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, Action>
     */
    public function getActions(): Collection
    {
        return $this->actions;
    }

    public function addAction(Action $action): self
    {
        if (!$this->actions->contains($action)) {
            $this->actions[] = $action;
            $action->setPlanification($this);
        }

        return $this;
    }

    public function removeAction(Action $action): self
    {
        if ($this->actions->removeElement($action)) {
            // set the owning side to null (unless already changed)
            if ($action->getPlanification() === $this) {
                $action->setPlanification(null);
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
        return $this->programme;
    }

   
}
