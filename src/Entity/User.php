<?php

namespace App\Entity;

use App\Traits\TimeStampTrait;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\HasLifecycleCallbacks()]

class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    use TimeStampTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 180, unique: true)]
    private $email;

    #[ORM\Column(type: 'json')]
    private $roles = [];

    #[ORM\Column(type: 'string')]
    private $password;

    #[ORM\OneToMany(mappedBy: 'createdBy', targetEntity: Programme::class)]
    private $programmes;

    #[ORM\OneToMany(mappedBy: 'createdBy', targetEntity: Categorie::class)]
    private $categories;

    #[ORM\OneToMany(mappedBy: 'createdBy', targetEntity: Province::class)]
    private $provinces;

    #[ORM\OneToMany(mappedBy: 'createdBy', targetEntity: UniteFonctionnelle::class)]
    private $uniteFonctionnelles;

    #[ORM\OneToMany(mappedBy: 'createdBy', targetEntity: Planification::class)]
    private $planifications;

    #[ORM\OneToMany(mappedBy: 'createdBy', targetEntity: Action::class)]
    private $actions;

    #[ORM\OneToMany(mappedBy: 'createdBy', targetEntity: SousAction::class)]
    private $sousActions;

    #[ORM\OneToMany(mappedBy: 'createdBy', targetEntity: SousActivite::class)]
    private $sousActivites;

    #[ORM\OneToMany(mappedBy: 'createdBy', targetEntity: Activite::class)]
    private $activites;

    #[ORM\OneToMany(mappedBy: 'createdBy', targetEntity: ZoneDeSante::class)]
    private $zoneDeSantes;

    #[ORM\OneToMany(mappedBy: 'createdBy', targetEntity: Ville::class)]
    private $villes;

    #[ORM\OneToMany(mappedBy: 'createdBy', targetEntity: Niveau::class)]
    private $niveaux;

    #[ORM\OneToMany(mappedBy: 'createdBy', targetEntity: TypeValidationUF::class)]
    private $typeValidationUFs;

    #[ORM\OneToMany(mappedBy: 'createdBy', targetEntity: Structure::class)]
    private $structures;


    public function __construct()
    {
        $this->programmes = new ArrayCollection();
        $this->categories = new ArrayCollection();
        $this->provinces = new ArrayCollection();
        $this->uniteFonctionnelles = new ArrayCollection();
        $this->planifications = new ArrayCollection();
        $this->actions = new ArrayCollection();
        $this->sousActions = new ArrayCollection();
        $this->sousActivites = new ArrayCollection();
        $this->activites = new ArrayCollection();
        $this->zoneDeSantes = new ArrayCollection();
        $this->villes = new ArrayCollection();
        $this->niveaux = new ArrayCollection();
        $this->typeValidationUFs = new ArrayCollection();
        $this->structures = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @return Collection<int, Programme>
     */
    public function getProgrammes(): Collection
    {
        return $this->programmes;
    }

    public function addProgramme(Programme $programme): self
    {
        if (!$this->programmes->contains($programme)) {
            $this->programmes[] = $programme;
            $programme->setCreatedBy($this);
        }

        return $this;
    }

    public function removeProgramme(Programme $programme): self
    {
        if ($this->programmes->removeElement($programme)) {
            // set the owning side to null (unless already changed)
            if ($programme->getCreatedBy() === $this) {
                $programme->setCreatedBy(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Categorie>
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Categorie $category): self
    {
        if (!$this->categories->contains($category)) {
            $this->categories[] = $category;
            $category->setCreatedBy($this);
        }

        return $this;
    }

    public function removeCategory(Categorie $category): self
    {
        if ($this->categories->removeElement($category)) {
            // set the owning side to null (unless already changed)
            if ($category->getCreatedBy() === $this) {
                $category->setCreatedBy(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Province>
     */
    public function getProvinces(): Collection
    {
        return $this->provinces;
    }

    public function addProvince(Province $province): self
    {
        if (!$this->provinces->contains($province)) {
            $this->provinces[] = $province;
            $province->setCreatedBy($this);
        }

        return $this;
    }

    public function removeProvince(Province $province): self
    {
        if ($this->provinces->removeElement($province)) {
            // set the owning side to null (unless already changed)
            if ($province->getCreatedBy() === $this) {
                $province->setCreatedBy(null);
            }
        }

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
            $uniteFonctionnelle->setCreatedBy($this);
        }

        return $this;
    }

    public function removeUniteFonctionnelle(UniteFonctionnelle $uniteFonctionnelle): self
    {
        if ($this->uniteFonctionnelles->removeElement($uniteFonctionnelle)) {
            // set the owning side to null (unless already changed)
            if ($uniteFonctionnelle->getCreatedBy() === $this) {
                $uniteFonctionnelle->setCreatedBy(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return $this->email;
    }

    /**
     * @return Collection<int, Planification>
     */
    public function getPlanifications(): Collection
    {
        return $this->planifications;
    }

    public function addPlanification(Planification $planification): self
    {
        if (!$this->planifications->contains($planification)) {
            $this->planifications[] = $planification;
            $planification->setCreatedBy($this);
        }

        return $this;
    }

    public function removePlanification(Planification $planification): self
    {
        if ($this->planifications->removeElement($planification)) {
            // set the owning side to null (unless already changed)
            if ($planification->getCreatedBy() === $this) {
                $planification->setCreatedBy(null);
            }
        }

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
            $action->setCreatedBy($this);
        }

        return $this;
    }

    public function removeAction(Action $action): self
    {
        if ($this->actions->removeElement($action)) {
            // set the owning side to null (unless already changed)
            if ($action->getCreatedBy() === $this) {
                $action->setCreatedBy(null);
            }
        }

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
            $sousAction->setCreatedBy($this);
        }

        return $this;
    }

    public function removeSousAction(SousAction $sousAction): self
    {
        if ($this->sousActions->removeElement($sousAction)) {
            // set the owning side to null (unless already changed)
            if ($sousAction->getCreatedBy() === $this) {
                $sousAction->setCreatedBy(null);
            }
        }

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
            $sousActivite->setCreatedBy($this);
        }

        return $this;
    }

    public function removeSousActivite(SousActivite $sousActivite): self
    {
        if ($this->sousActivites->removeElement($sousActivite)) {
            // set the owning side to null (unless already changed)
            if ($sousActivite->getCreatedBy() === $this) {
                $sousActivite->setCreatedBy(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Activite>
     */
    public function getActivites(): Collection
    {
        return $this->activites;
    }

    public function addActivite(Activite $activite): self
    {
        if (!$this->activites->contains($activite)) {
            $this->activites[] = $activite;
            $activite->setCreatedBy($this);
        }

        return $this;
    }

    public function removeActivite(Activite $activite): self
    {
        if ($this->activites->removeElement($activite)) {
            // set the owning side to null (unless already changed)
            if ($activite->getCreatedBy() === $this) {
                $activite->setCreatedBy(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ZoneDeSante>
     */
    public function getZoneDeSantes(): Collection
    {
        return $this->zoneDeSantes;
    }

    public function addZoneDeSante(ZoneDeSante $zoneDeSante): self
    {
        if (!$this->zoneDeSantes->contains($zoneDeSante)) {
            $this->zoneDeSantes[] = $zoneDeSante;
            $zoneDeSante->setCreatedBy($this);
        }

        return $this;
    }

    public function removeZoneDeSante(ZoneDeSante $zoneDeSante): self
    {
        if ($this->zoneDeSantes->removeElement($zoneDeSante)) {
            // set the owning side to null (unless already changed)
            if ($zoneDeSante->getCreatedBy() === $this) {
                $zoneDeSante->setCreatedBy(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Ville>
     */
    public function getVilles(): Collection
    {
        return $this->villes;
    }

    public function addVille(Ville $ville): self
    {
        if (!$this->villes->contains($ville)) {
            $this->villes[] = $ville;
            $ville->setCreatedBy($this);
        }

        return $this;
    }

    public function removeVille(Ville $ville): self
    {
        if ($this->villes->removeElement($ville)) {
            // set the owning side to null (unless already changed)
            if ($ville->getCreatedBy() === $this) {
                $ville->setCreatedBy(null);
            }
        }

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
            $niveau->setCreatedBy($this);
        }

        return $this;
    }

    public function removeNiveau(Niveau $niveau): self
    {
        if ($this->niveaux->removeElement($niveau)) {
            // set the owning side to null (unless already changed)
            if ($niveau->getCreatedBy() === $this) {
                $niveau->setCreatedBy(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, TypeValidationUF>
     */
    public function getTypeValidationUFs(): Collection
    {
        return $this->typeValidationUFs;
    }

    public function addTypeValidationUF(TypeValidationUF $typeValidationUF): self
    {
        if (!$this->typeValidationUFs->contains($typeValidationUF)) {
            $this->typeValidationUFs[] = $typeValidationUF;
            $typeValidationUF->setCreatedBy($this);
        }

        return $this;
    }

    public function removeTypeValidationUF(TypeValidationUF $typeValidationUF): self
    {
        if ($this->typeValidationUFs->removeElement($typeValidationUF)) {
            // set the owning side to null (unless already changed)
            if ($typeValidationUF->getCreatedBy() === $this) {
                $typeValidationUF->setCreatedBy(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Structure>
     */
    public function getStructures(): Collection
    {
        return $this->structures;
    }

    public function addStructure(Structure $structure): self
    {
        if (!$this->structures->contains($structure)) {
            $this->structures[] = $structure;
            $structure->setCreatedBy($this);
        }

        return $this;
    }

    public function removeStructure(Structure $structure): self
    {
        if ($this->structures->removeElement($structure)) {
            // set the owning side to null (unless already changed)
            if ($structure->getCreatedBy() === $this) {
                $structure->setCreatedBy(null);
            }
        }

        return $this;
    }

}
