<?php

require_once "Robot.php";

// Créer un robot
// => créer une variable de type Robot (de la classe Robot)
$bip = new Robot("bip", 100);
// $bip->energie = 100;
// $bip->nom = "bip";
var_dump($bip);
echo $bip->obtenirEnergie();

$bip->jouer();
echo PHP_EOL;
echo $bip->obtenirEnergie();
$bip->recharger(30);