<?php

// Déclaration de la classe Robot

class Robot
{
    // Caractéristiques d'un robot
    private string $nom;
    private int $energie;

    // Fonction permettant d'initialiser un objet Robot
    // lors de sa création
    // Equivalent fonction creerRobot
    public function __construct(string $nom, int $energie)
    {
        $this->nom = $nom;
        $this->energie = $energie;
    }

    // Fonction permettant d'obtenir le nom d'un robot
    public function obtenirNom(): string
    {
        return $this->nom;
    }

    // Fonction permettant d'obtenir l'énergie d'un robot
    public function obtenirEnergie(): int
    {
        return $this->energie;
    }

    // Fonction permettant au robot de jouer
    public function jouer(): bool
    {
        if ($this->energie < 20) {
            return false;
        }

        // On retire 20 unités d'énergie
        $this->energie -= 20;
        return true;
    }

    // Fonction permettant au robot de se recharger
    public function recharger(int $quantite): bool
    {
        if ($quantite <= 0) {
            return false;
        }
        // On recharge
        $ajoutEnergie = min($quantite, 100 - $this->energie);
        $this->energie += $ajoutEnergie;
        return true;
    }
}