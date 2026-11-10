<?php

require_once "Materiel.php";

$casque = new Materiel("Casque");
$calculatrice = new Materiel("Calculatrice");
echo $casque->decrire() . PHP_EOL;
echo $calculatrice->decrire() . PHP_EOL;
$reussite = $casque->emprunter("Lina");
if ($reussite) {
    echo "accepté \n";
} else {
    echo "refusé \n";
}
echo $casque->decrire() . PHP_EOL;
$reussite = $casque->emprunter("Sami");
if ($reussite) {
    echo "accepté \n";
} else {
    echo "refusé \n";
}
echo $casque->decrire() . PHP_EOL;
$reussite = $calculatrice->emprunter("Sami");
if ($reussite) {
    echo "accepté \n";
} else {
    echo "refusé \n";
}
echo $calculatrice->decrire() . PHP_EOL;
$casque->rendre();
echo $casque->decrire() . PHP_EOL;
echo $calculatrice->decrire() . PHP_EOL;
$reussite = $casque->rendre();
if ($reussite) {
    echo "accepté \n";
} else {
    echo "refusé \n";
}
echo $casque->decrire() . PHP_EOL;
$reussite = $casque->emprunter("     ");
if ($reussite) {
    echo "accepté \n";
} else {
    echo "refusé \n";
}
echo $casque->decrire() . PHP_EOL;