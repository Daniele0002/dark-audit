<?php

namespace App\Entity;

use App\Repository\DarkPatternRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DarkPatternRepository::class)]
class DarkPattern
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'patterns')]
    private ?DarkPatternCategory $category = null;

    /**
     * @var Collection<int, DarkPatternCharacteristic>
     */
    #[ORM\ManyToMany(targetEntity: DarkPatternCharacteristic::class, inversedBy: 'darkPatterns')]
    private Collection $characteristics;

    public function __construct()
    {
        $this->characteristics = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getCategory(): ?DarkPatternCategory
    {
        return $this->category;
    }

    public function setCategory(?DarkPatternCategory $category): static
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return Collection<int, DarkPatternCharacteristic>
     */
    public function getCharacteristics(): Collection
    {
        return $this->characteristics;
    }

    public function addCharacteristic(DarkPatternCharacteristic $characteristic): static
    {
        if (!$this->characteristics->contains($characteristic)) {
            $this->characteristics->add($characteristic);
        }

        return $this;
    }

    public function removeCharacteristic(DarkPatternCharacteristic $characteristic): static
    {
        $this->characteristics->removeElement($characteristic);

        return $this;
    }
}
