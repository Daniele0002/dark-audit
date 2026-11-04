<?php

namespace App\Entity;

use App\Repository\DarkPatternCategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DarkPatternCategoryRepository::class)]
class DarkPatternCategory
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    /**
     * @var Collection<int, DarkPattern>
     */
    #[ORM\OneToMany(targetEntity: DarkPattern::class, mappedBy: 'category')]
    private Collection $patterns;

    public function __construct()
    {
        $this->patterns = new ArrayCollection();
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

    /**
     * @return Collection<int, DarkPattern>
     */
    public function getPatterns(): Collection
    {
        return $this->patterns;
    }

    public function addPattern(DarkPattern $pattern): static
    {
        if (!$this->patterns->contains($pattern)) {
            $this->patterns->add($pattern);
            $pattern->setCategory($this);
        }

        return $this;
    }

    public function removePattern(DarkPattern $pattern): static
    {
        if ($this->patterns->removeElement($pattern)) {
            // set the owning side to null (unless already changed)
            if ($pattern->getCategory() === $this) {
                $pattern->setCategory(null);
            }
        }

        return $this;
    }
}
