<?php

namespace App\Entity;

use App\Repository\ScanResultRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ScanResultRepository::class)]
class ScanResult
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $evidence = null;

    #[ORM\Column(nullable: true)]
    private ?float $confidence = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\ManyToOne(inversedBy: 'scanResults')]
#[ORM\JoinColumn(nullable: false)]
private ?Scan $scan = null;

#[ORM\ManyToOne(inversedBy: 'scanResults')]
#[ORM\JoinColumn(nullable: false)]
private ?DarkPattern $darkPattern = null;

#[ORM\ManyToOne(inversedBy: 'scanResults')]
#[ORM\JoinColumn(nullable: false)]
private ?DetectionRule $detectionRule = null;
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEvidence(): ?string
    {
        return $this->evidence;
    }

    public function setEvidence(string $evidence): static
    {
        $this->evidence = $evidence;

        return $this;
    }

    public function getConfidence(): ?float
    {
        return $this->confidence;
    }

    public function setConfidence(?float $confidence): static
    {
        $this->confidence = $confidence;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getScan(): ?Scan
    {
        return $this->scan;
    }

    public function setScan(?Scan $scan): static
    {
        $this->scan = $scan;

        return $this;
    }

    public function getDarkPattern(): ?DarkPattern
    {
        return $this->darkPattern;
    }

    public function setDarkPattern(?DarkPattern $darkPattern): static
    {
        $this->darkPattern = $darkPattern;

        return $this;
    }

    public function getDetectionRule(): ?DetectionRule
    {
        return $this->detectionRule;
    }

    public function setDetectionRule(?DetectionRule $detectionRule): static
    {
        $this->detectionRule = $detectionRule;

        return $this;
    }
}
