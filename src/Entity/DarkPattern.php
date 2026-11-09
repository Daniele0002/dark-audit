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
    // Identificativo univoco del Dark Pattern nel database
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    // Nome del Dark Pattern (es. Low-stock Message)
    #[ORM\Column(length: 255)]
    private ?string $name = null;

    // Descrizione teorica del Dark Pattern
    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    // Categoria di appartenenza del Dark Pattern
    // Relazione ManyToOne: più Dark Pattern possono appartenere alla stessa categoria
    #[ORM\ManyToOne(inversedBy: 'patterns')]
    private ?DarkPatternCategory $category = null;

    /**
     * Caratteristiche associate al Dark Pattern.
     *
     * Relazione ManyToMany:
     * un Dark Pattern può avere più caratteristiche
     * e una caratteristica può appartenere a più Dark Pattern.
     *
     * @var Collection<int, DarkPatternCharacteristic>
     */
    #[ORM\ManyToMany(targetEntity: DarkPatternCharacteristic::class, inversedBy: 'darkPatterns')]
    private Collection $characteristics;

    /**
     * Regole di rilevamento associate al Dark Pattern.
     *
     * Relazione OneToMany:
     * un Dark Pattern può avere più regole di rilevamento,
     * mentre ogni regola appartiene a un solo Dark Pattern.
     *
     * @var Collection<int, DetectionRule>
     */
    #[ORM\OneToMany(mappedBy: 'darkPattern', targetEntity: DetectionRule::class)]
    private Collection $detectionRules;

    /**
     * @var Collection<int, ScanResult>
     */
    #[ORM\OneToMany(targetEntity: ScanResult::class, mappedBy: 'darkPattern')]
    private Collection $scanResults;

    /**
     * Costruttore dell'entità.
     *
     * Inizializza le raccolte delle caratteristiche e delle regole.
     * ArrayCollection permette di gestire queste relazioni anche
     * quando non contengono ancora elementi.
     */
    public function __construct()
    {
        $this->characteristics = new ArrayCollection();
        $this->detectionRules = new ArrayCollection();
        $this->scanResults = new ArrayCollection();
    }

    // Restituisce l'identificativo del Dark Pattern
    public function getId(): ?int
    {
        return $this->id;
    }

    // Restituisce il nome del Dark Pattern
    public function getName(): ?string
    {
        return $this->name;
    }

    // Imposta il nome del Dark Pattern
    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    // Restituisce la descrizione del Dark Pattern
    public function getDescription(): ?string
    {
        return $this->description;
    }

    // Imposta la descrizione del Dark Pattern
    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    // Restituisce la categoria a cui appartiene il Dark Pattern
    public function getCategory(): ?DarkPatternCategory
    {
        return $this->category;
    }

    // Associa il Dark Pattern a una categoria
    public function setCategory(?DarkPatternCategory $category): static
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Restituisce tutte le caratteristiche associate al Dark Pattern.
     *
     * @return Collection<int, DarkPatternCharacteristic>
     */
    public function getCharacteristics(): Collection
    {
        return $this->characteristics;
    }

    // Associa una caratteristica al Dark Pattern
    public function addCharacteristic(DarkPatternCharacteristic $characteristic): static
    {
        // Evita di inserire due volte la stessa caratteristica
        if (!$this->characteristics->contains($characteristic)) {
            $this->characteristics->add($characteristic);
        }

        return $this;
    }

    // Rimuove una caratteristica dal Dark Pattern
    public function removeCharacteristic(DarkPatternCharacteristic $characteristic): static
    {
        $this->characteristics->removeElement($characteristic);

        return $this;
    }

    /**
     * Restituisce tutte le regole di rilevamento associate al Dark Pattern.
     *
     * @return Collection<int, DetectionRule>
     */
    public function getDetectionRules(): Collection
    {
        return $this->detectionRules;
    }

    /**
     * Associa una nuova regola di rilevamento al Dark Pattern.
     *
     * Aggiorna anche il riferimento nella DetectionRule,
     * perché è quest'ultima a gestire il collegamento nel database.
     */
    public function addDetectionRule(DetectionRule $detectionRule): static
    {
        // Evita di aggiungere due volte la stessa regola
        if (!$this->detectionRules->contains($detectionRule)) {
            $this->detectionRules->add($detectionRule);

            // Imposta il Dark Pattern di appartenenza della regola
            $detectionRule->setDarkPattern($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, ScanResult>
     */
    public function getScanResults(): Collection
    {
        return $this->scanResults;
    }

    public function addScanResult(ScanResult $scanResult): static
    {
        if (!$this->scanResults->contains($scanResult)) {
            $this->scanResults->add($scanResult);
            $scanResult->setDarkPattern($this);
        }

        return $this;
    }

    public function removeScanResult(ScanResult $scanResult): static
    {
        if ($this->scanResults->removeElement($scanResult)) {
            // set the owning side to null (unless already changed)
            if ($scanResult->getDarkPattern() === $this) {
                $scanResult->setDarkPattern(null);
            }
        }

        return $this;
    }
}