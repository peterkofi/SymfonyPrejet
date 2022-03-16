<?php

namespace App\Entity;

use App\Traits\TimeStampTrait;
use App\Repository\VilleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VilleRepository::class)]
#[ORM\HasLifecycleCallbacks()]

class Ville
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

    #[ORM\ManyToOne(targetEntity: Province::class, inversedBy: 'villes')]
    private $province;

    #[ORM\OneToMany(mappedBy: 'ville', targetEntity: ZoneDeSante::class)]
    private $zoneDeSantes;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'villes')]
    private $createdBy;

    public function __construct()
    {
        $this->zoneDeSantes = new ArrayCollection();
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

    public function getProvince(): ?Province
    {
        return $this->province;
    }

    public function setProvince(?Province $province): self
    {
        $this->province = $province;

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
            $zoneDeSante->setVille($this);
        }

        return $this;
    }

    public function removeZoneDeSante(ZoneDeSante $zoneDeSante): self
    {
        if ($this->zoneDeSantes->removeElement($zoneDeSante)) {
            // set the owning side to null (unless already changed)
            if ($zoneDeSante->getVille() === $this) {
                $zoneDeSante->setVille(null);
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
