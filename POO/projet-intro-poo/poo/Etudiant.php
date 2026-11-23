<?php

// Déclaration de la classe Etudiant

class Etudiant
{
    // Caractéristiques d'un étudiant
    private string $prenom;
    private string $nom;
    private array $notes;

    // Fonction permettant d'initialiser un objet Etudiant lors de sa création
    public function __construct(string $prenom, string $nom)
    {
        $this->prenom = $prenom;
        $this->nom = $nom;
        $this->notes = [];
    }

    // Fonction permettant d'obtenir l'identité complète d'un étudiant
    public function obtenirIdentite(): string
    {
        return "{$this->prenom} {$this->nom}";
    }

    // Fonction permettant d'ajouter une note à un étudiant
    public function ajouterNote(float $note): bool
    {
        // Vérifier si la note est comprise entre 0 et 20 (bornes comprises)
        if ($note < 0 || $note > 20) {
            return false;
        }
        // Ajouter la note au tableau des notes
        $this->notes[] = $note;
        return true;
    }

    // Fonction permettant de consulter les notes d'un étudiant
    public function consulterNotes(): array
    {
        return $this->notes;
    }

    // Fonction permettant de calculer la moyenne des notes d'un étudiant
    public function calculerMoyenne(): ?float
    {
        if ($this->notes === []) {
            return null;
        }
        // return array_sum($this->notes) / count($this->notes);
        $somme = 0;
        foreach ($this->notes as $note) {
            $somme += $note;
        }
        return round($somme / count($this->notes), 2);
    }
}