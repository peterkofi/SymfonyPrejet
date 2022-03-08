<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
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

    public function __construct()
    {
        $this->programmes = new ArrayCollection();
        $this->categories = new ArrayCollection();
        $this->provinces = new ArrayCollection();
        $this->uniteFonctionnelles = new ArrayCollection();
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
}
