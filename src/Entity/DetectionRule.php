<?php

namespace App\Entity;

use App\Repository\DetectionRuleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DetectionRuleRepository::class)]
class DetectionRule
{
    // Identificativo univoco della regola nel database
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    // Nome identificativo della regola
    // Es. "Rilevamento messaggi di scarsa disponibilità"
    #[ORM\Column(length: 255)]
    private ?string $name = null;

    // Descrizione generale dello scopo della regola
    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    // Tipologia di analisi utilizzata dalla regola
    // Es. "Text", "Semantic", "DOM", "Visual" o "Behavioral"
    #[ORM\Column(length: 255)]
    private ?string $analysisType = null;

    // Condizioni e indicatori che permettono di individuare il pattern
    #[ORM\Column(type: Types::TEXT)]
    private ?string $detectionCondition = null;

    // Casi da escludere per evitare segnalazioni non pertinenti
    #[ORM\Column(type: Types::TEXT)]
    private ?string $exclusions = null;

    // Limiti conosciuti della regola e possibili falsi positivi
    #[ORM\Column(type: Types::TEXT)]
    private ?string $limitations = null;

    /**
     * Dark Pattern a cui appartiene questa regola.
     *
     * Relazione ManyToOne:
     * più regole possono appartenere allo stesso Dark Pattern,
     * ma ogni regola è associata a un solo Dark Pattern.
     *
     * JoinColumn nullable: false:
     * ogni regola deve essere associata a un Dark Pattern
     * prima di essere salvata nel database.
     */
    #[ORM\ManyToOne(inversedBy: 'detectionRules')]
    #[ORM\JoinColumn(nullable: false)]
    private ?DarkPattern $darkPattern = null;

    /**
     * @var Collection<int, ScanResult>
     */
    #[ORM\OneToMany(targetEntity: ScanResult::class, mappedBy: 'detectionRule')]
    private Collection $scanResults;

    public function __construct()
    {
        $this->scanResults = new ArrayCollection();
    }

    // Restituisce l'identificativo della regola
    public function getId(): ?int
    {
        return $this->id;
    }

    // Restituisce il nome della regola
    public function getName(): ?string
    {
        return $this->name;
    }

    // Imposta il nome della regola
    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    // Restituisce la descrizione della regola
    public function getDescription(): ?string
    {
        return $this->description;
    }

    // Imposta la descrizione della regola
    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    // Restituisce la tipologia di analisi utilizzata
    public function getAnalysisType(): ?string
    {
        return $this->analysisType;
    }

    // Imposta la tipologia di analisi
    public function setAnalysisType(string $analysisType): static
    {
        $this->analysisType = $analysisType;

        return $this;
    }

    // Restituisce le condizioni di rilevamento
    public function getDetectionCondition(): ?string
    {
        return $this->detectionCondition;
    }

    // Imposta le condizioni di rilevamento
    public function setDetectionCondition(string $detectionCondition): static
    {
        $this->detectionCondition = $detectionCondition;

        return $this;
    }

    // Restituisce i casi da escludere
    public function getExclusions(): ?string
    {
        return $this->exclusions;
    }

    // Imposta i casi da escludere
    public function setExclusions(string $exclusions): static
    {
        $this->exclusions = $exclusions;

        return $this;
    }

    // Restituisce i limiti conosciuti della regola
    public function getLimitations(): ?string
    {
        return $this->limitations;
    }

    // Imposta i limiti conosciuti della regola
    public function setLimitations(string $limitations): static
    {
        $this->limitations = $limitations;

        return $this;
    }

    // Restituisce il Dark Pattern a cui appartiene la regola
    public function getDarkPattern(): ?DarkPattern
    {
        return $this->darkPattern;
    }

    // Associa la regola a un Dark Pattern
    public function setDarkPattern(DarkPattern $darkPattern): static
    {
        $this->darkPattern = $darkPattern;

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
            $scanResult->setDetectionRule($this);
        }

        return $this;
    }

    public function removeScanResult(ScanResult $scanResult): static
    {
        if ($this->scanResults->removeElement($scanResult)) {
            // set the owning side to null (unless already changed)
            if ($scanResult->getDetectionRule() === $this) {
                $scanResult->setDetectionRule(null);
            }
        }

        return $this;
    }
}