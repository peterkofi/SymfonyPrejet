<?php

namespace App\Entity;


use App\Traits\TimeStampTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\NiveauRepository;

#[ORM\Entity(repositoryClass: NiveauRepository::class)]
#[ORM\HasLifecycleCallbacks()]

class Niveau
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

    #[ORM\ManyToMany(targetEntity: Province::class, inversedBy: 'niveaux')]
    private $province;

    #[ORM\OneToMany(mappedBy: 'niveau', targetEntity: Categorie::class)]
    private $categories;

    public function __construct()
    {
        $this->province = new ArrayCollection();
        $this->categories = new ArrayCollection();
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
     * @return Collection<int, Province>
     */
    public function getProvince(): Collection
    {
        return $this->province;
    }

    public function addProvince(Province $province): self
    {
        if (!$this->province->contains($province)) {
            $this->province[] = $province;
        }

        return $this;
    }

    public function removeProvince(Province $province): self
    {
        $this->province->removeElement($province);

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
            $category->setNiveau($this);
        }

        return $this;
    }

    public function removeCategory(Categorie $category): self
    {
        if ($this->categories->removeElement($category)) {
            // set the owning side to null (unless already changed)
            if ($category->getNiveau() === $this) {
                $category->setNiveau(null);
            }
        }

        return $this;
    }

}
