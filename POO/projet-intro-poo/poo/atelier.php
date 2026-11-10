<?php

require_once "VeloAtelier.php";

$rouge = new VeloAtelier("Le Rouge");
$bleu = new VeloAtelier("Le Bleu");
$reussite = $rouge->reparer(100);
if ($reussite) {
    echo "accepté \n";
} else {
    echo "refusé \n";
}
echo $rouge->decrire() . PHP_EOL;
$reussite = $rouge->diagnostiquer(25);
if ($reussite) {
    echo "accepté \n";
} else {
    echo "refusé \n";
}
echo $rouge->decrire() . PHP_EOL;
$reussite = $rouge->diagnostiquer(5);
if ($reussite) {
    echo "accepté \n";
} else {
    echo "refusé \n";
}
echo $rouge->decrire() . PHP_EOL;
$reussite = $rouge->reparer(20);
if ($reussite) {
    echo "accepté \n";
} else {
    echo "refusé \n";
}
echo $rouge->decrire() . PHP_EOL;
$reussite = $rouge->reparer(25);
if ($reussite) {
    echo "accepté \n";
} else {
    echo "refusé \n";
}
echo $rouge->decrire() . PHP_EOL;
$reussite = $rouge->rendre();
if ($reussite) {
    echo "accepté \n";
} else {
    echo "refusé \n";
}
echo $rouge->decrire() . PHP_EOL;
$reussite = $rouge->rendre();
if ($reussite) {
    echo "accepté \n";
} else {
    echo "refusé \n";
}
echo $rouge->decrire() . PHP_EOL;
echo $bleu->decrire() . PHP_EOL;