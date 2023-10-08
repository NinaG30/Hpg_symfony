<?php

namespace App\Entity;

use App\Repository\ResultRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ResultRepository::class)]
class Result
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $panneauxNecessaires = null;

    #[ORM\Column(nullable: true)]
    private ?int $panneauxInstallables = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $economie = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?FormData $formData = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPanneauxNecessaires(): ?int
    {
        return $this->panneauxNecessaires;
    }

    public function setPanneauxNecessaires(int $panneauxNecessaires): static
    {
        $this->panneauxNecessaires = $panneauxNecessaires;

        return $this;
    }

    public function getPanneauxInstallables(): ?int
    {
        return $this->panneauxInstallables;
    }

    public function setPanneauxInstallables(?int $panneauxInstallables): static
    {
        $this->panneauxInstallables = $panneauxInstallables;

        return $this;
    }

    public function getEconomie(): ?string
    {
        return $this->economie;
    }

    public function setEconomie(?string $economie): static
    {
        $this->economie = $economie;

        return $this;
    }

    public function getFormData(): ?FormData
    {
        return $this->formData;
    }

    public function setFormData(FormData $formData): static
    {
        $this->formData = $formData;

        return $this;
    }
}
