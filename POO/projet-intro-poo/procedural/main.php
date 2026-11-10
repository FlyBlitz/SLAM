<?php

// Programme principal

// require_once "donnees_robot.php";
require_once "fonctions_robot.php";

$bip = creerRobot("bip", 100);
if ($bip === null) {
    echo "Erreur de validation, création impossible";
    exit(0);
}

// Afficher l'énergie de $bip
echo obtenirEnergieRobot($bip);
echo PHP_EOL;
echo obtenirNomRobot($bip);
echo PHP_EOL;
if (jouerRobot($bip)) {
    echo "bip a joué !";
    echo PHP_EOL;
    echo "Energie restante : " . obtenirEnergieRobot($bip);
} else {
    echo "bip n'a pas pu jouer par manque d'énergie !";
}
echo PHP_EOL;
rechargerRobot($bip, 40);
echo "Energie restante : " . obtenirEnergieRobot($bip);