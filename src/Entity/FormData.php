<?php

namespace App\Entity;

use App\Repository\FormDataRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FormDataRepository::class)]
class FormData
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[ORM\Column]
    private ?int $longueurToiture = null;

    #[ORM\Column]
    private ?int $largeurToiture = null;

    #[ORM\Column]
    private ?int $montantFacture = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getLongueurToiture(): ?int
    {
        return $this->longueurToiture;
    }

    public function setLongueurToiture(int $longueurToiture): static
    {
        $this->longueurToiture = $longueurToiture;

        return $this;
    }

    public function getLargeurToiture(): ?int
    {
        return $this->largeurToiture;
    }

    public function setLargeurToiture(int $largeurToiture): static
    {
        $this->largeurToiture = $largeurToiture;

        return $this;
    }

    public function getMontantFacture(): ?int
    {
        return $this->montantFacture;
    }

    public function setMontantFacture(int $montantFacture): static
    {
        $this->montantFacture = $montantFacture;

        return $this;
    }
}
