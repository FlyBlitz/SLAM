<?php

require_once "Etudiant.php";

// Création des objets (=> 2 étudiants)
$lina = new Etudiant("Lina", "Martin");
$sami = new Etudiant("Sami", "Bernard");

echo $lina->obtenirIdentite();
echo PHP_EOL;

$lina->ajouterNote(12);
$lina->ajouterNote(21);
$lina->ajouterNote(15.5);
$lina->ajouterNote(9);

$notes = $lina->consulterNotes();
if ($notes === []) {
    echo "Aucune note !" . PHP_EOL;
} else {
    foreach ($notes as $note) {
        echo $note . "/20" . PHP_EOL;
    }
}
$moyenne = $lina->calculerMoyenne();