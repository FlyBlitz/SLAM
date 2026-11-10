<?php

require_once "fonctions_robot.php";

$bip = creerRobot("bip", 100);
echo obtenirEnergieRobot($bip);

// Problème n°1
// Contourner la fonction de création d'un robot
// Les RG ne sont plus appliquées
$bop = [
    "nom" => "ff dfdkfdf dfdf",
    "energie" => 250,
];
echo PHP_EOL;

echo obtenirEnergieRobot($bop);

// Problème n°2
// Violation des RG par modification directe
$bip = creerRobot("bip", 100);
echo obtenirEnergieRobot($bip);
echo PHP_EOL;
$bip["energie"] = 300;
echo obtenirEnergieRobot($bip);
echo PHP_EOL;

// Problème n°3
// Aucune garantie sur les clés du tableau
// (Fautes de frappe "silencieuses")
echo PHP_EOL;
$bip["enrgie"] = 200;
var_dump($bip);

// Problème n°4
// Le type array est trop permissif
echo PHP_EOL;
$voiture = [
    "marque" => "Peugeot",
    "modèle" => 206,
];
jouerRobot($voiture);