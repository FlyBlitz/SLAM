<?php

// Fonctions permettant de "manipuler" un robot

// Fonction permettant de créer un robot
// Appliquer les règles de gestion demandées
function creerRobot(string $nom, int $energie): ?array
{
    // Validation du nom
    if (strlen($nom) < 3 || str_contains($nom, " ")) {
        return null;
    }
    // Validation de l'énergie
    if ($energie < 0 || $energie > 100) {
        return null;
    }

    // Création du robot (le tableau représentant le robot)
    return [
        "nom" => $nom,
        "energie" => $energie,
    ];
}


// Fonction permettant d'obtenir le nom d'un robot
function obtenirNomRobot(array $robot): string
{
    return $robot['nom'];
}

// Fonction permettant d'obtenir l'énergie d'un robot
function obtenirEnergieRobot(array $robot): int
{
    return $robot['energie'];
}

// Fonction permettant au robot de jouer
function jouerRobot(array &$robot): bool
{
    if ($robot['energie'] < 20) {
        return false;
    }

    // On retire 20 unités d'énergie
    $robot['energie'] -= 20;
    return true;
}

// Fonction permettant au robot de se recharger
function rechargerRobot(array &$robot, int $quantite): bool
{
    if ($quantite <= 0) {
        return false;
    }
    // On recharge
    $ajoutEnergie = min($quantite, 100 - $robot['energie']);
    $robot['energie'] += $ajoutEnergie;
    return true;
}