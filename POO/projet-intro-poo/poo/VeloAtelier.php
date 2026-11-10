<?php

// Déclaration de la classe VeloAtelier

class VeloAtelier
{
    // Caractéristiques d'un vélo d'atelier
    private string $nom;
    private string $etat;
    private int $devis;

    // Fonction permettant d'initialiser un objet VeloAtelier lors de sa création
    public function __construct(string $nom)
    {
        $this->nom = $nom;
        $this->etat = "déposé";
        $this->devis = 0;
    }

    // Fonction permettant de diagnostiquer un vélo d'atelier
    public function diagnostiquer(int $montant): bool
    {
        if ($this->etat !== "déposé" || $montant < 0) {
            return false;
        }
        $this->devis = $montant;
        $this->etat = "diagnostiqué";
        return true;
    }

    // Fonction permettant de réparer un vélo d'atelier
    public function reparer(int $budget): bool
    {
        if ($this->etat !== "diagnostiqué" || $budget < $this->devis) {
            return false;
        }
        $this->etat = "réparé";
        return true;
    }

    // Fonction permettant de rendre un vélo d'atelier
    public function rendre(): bool
    {
        if ($this->etat !== "réparé") {
            return false;
        }
        $this->etat = "rendu";
        return true;
    }

    // Fonction permettant de décrire un vélo d'atelier
    public function decrire(): string
    {
        $devis = $this->etat !== "déposé" ? "Devis : {$this->devis}." : "";
        return "{$this->nom} est actuellement {$this->etat}. {$devis}";
    }
}