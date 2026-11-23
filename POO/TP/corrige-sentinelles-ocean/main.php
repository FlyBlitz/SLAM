<?php

declare(strict_types=1);

require_once __DIR__ . '/Station.php';
require_once __DIR__ . '/Drone.php';
require_once __DIR__ . '/Observation.php';

// 1. Création des objets avec leurs constructeurs.
$neree = new Station('Nérée', 'Fosse des Brumes');
$calypso = new Station('Calypso', 'Récif des Échos');

$ner01 = new Drone('NER-01', 300);
$ner02 = new Drone('NER-02', 800);
$cal01 = new Drone('CAL-01', 150);

$observation1 = new Observation('Méduse luminescente', 120, 4);
$observation2 = new Observation('Fragment de coque ancienne', 260, 5);
$observation3 = new Observation('Source hydrothermale', 720, 5);

// 2. Association des drones aux stations.
$neree->ajouterDrone($ner01);
$neree->ajouterDrone($ner02);
$calypso->ajouterDrone($cal01);

// 3. Association des observations aux drones.
$ner01->ajouterObservation($observation1);
$ner01->ajouterObservation($observation2);
$ner02->ajouterObservation($observation3);

// Chaque objet est associé à un seul parent par ce programme.
// CAL-01 ne possède aucune observation.

// 4. Vérification du refus des doublons dans une même collection.
echo '=== REFUS DES DOUBLONS ===' . PHP_EOL;

$resultat = $neree->ajouterDrone($ner01);
echo 'Second ajout de NER-01 dans Nérée : ';
echo $resultat ? 'accepté' : 'refusé';
echo PHP_EOL;

$resultat = $ner01->ajouterObservation($observation1);
echo 'Second ajout de la même observation dans NER-01 : ';
echo $resultat ? 'accepté' : 'refusé';
echo PHP_EOL;

// 5. Compte rendu calculé à partir des objets.
echo PHP_EOL . '=== COMPTE RENDU ===' . PHP_EOL;

$stations = [$neree, $calypso];

foreach ($stations as $station) {
    echo PHP_EOL;
    echo 'Station : ' . $station->getNom() . PHP_EOL;
    echo 'Zone : ' . $station->getZoneMaritime() . PHP_EOL;
    echo 'Nombre de drones : ' . $station->getNombreDrones() . PHP_EOL;

    foreach ($station->getDrones() as $drone) {
        echo PHP_EOL;
        echo '  Drone : ' . $drone->getIdentifiant() . PHP_EOL;
        echo '  Profondeur maximale : ';
        echo $drone->getProfondeurMaximale() . ' m' . PHP_EOL;
        echo '  Nombre d’observations : ';
        echo $drone->getNombreObservations() . PHP_EOL;

        $profondeur = $drone->getPlusGrandeProfondeurObservee();

        if ($profondeur === null) {
            echo '  Aucune observation.' . PHP_EOL;
        } else {
            echo '  Plus grande profondeur observée : ';
            echo $profondeur . ' m' . PHP_EOL;
        }

        foreach ($drone->getObservations() as $observation) {
            echo '    - ' . $observation->getDescription();
            echo ' | ' . $observation->getProfondeur() . ' m';
            echo ' | intérêt : ';
            echo $observation->getInteretScientifique() . '/5';
            echo PHP_EOL;
        }
    }
}

