<?php

// Déclaration de la classe Materiel

class Materiel
{
    // Caractéristiques d'un matériel
    private string $nom;
    private string $emprunteur;
    private bool $estEmprunte;

    // Fonction permettant d'initialiser un objet Materiel lors de sa création
    public function __construct(string $nom)
    {
        $this->nom = $nom;
        $this->emprunteur = "";
        $this->estEmprunte = false;
    }

    // Fonction permettant d'emprunter un matériel
    public function emprunter(string $prenom): bool
    {
        $prenom = trim($prenom);
        if ($prenom === "" || $this->estEmprunte) {
            return false;
        }
        $this->emprunteur = $prenom;
        $this->estEmprunte = true;
        return true;
    }

    // Fonction permettant de rendre un matériel
    public function rendre(): bool
    {
        if (!$this->estEmprunte) {
            return false;
        }
        $this->emprunteur = "";
        $this->estEmprunte = false;
        return true;
    }

    // Fonction permettant de décrire un matériel
    public function decrire(): string
    {
        if ($this->estEmprunte) {
            return "{$this->nom} prêté à {$this->emprunteur}.";
        }
        return "{$this->nom} disponible.";
    }
}