<?php

declare(strict_types=1);

require_once __DIR__ . '/Station.php';
require_once __DIR__ . '/Drone.php';
require_once __DIR__ . '/Observation.php';

// 1. Création des stations.
$neree = new Station('Nérée', 'Fosse des Brumes');
$calypso = new Station('Calypso', 'Récif des Échos');

// 2. Création des drones : chaque constructeur inscrit le drone
//    dans la collection de sa station.
$ner01 = new Drone('NER-01', 300, $neree);
$ner02 = new Drone('NER-02', 800, $neree);
$cal01 = new Drone('CAL-01', 150, $calypso);

// 3. Création des observations : chaque constructeur inscrit
//    l'observation dans la collection de son drone.
$observation1 = new Observation('Méduse luminescente', 120, 4, $ner01);
$observation2 = new Observation('Fragment de coque ancienne', 260, 5, $ner01);
$observation3 = new Observation('Source hydrothermale', 720, 5, $ner02);

// CAL-01 reste sans observation.

// 4. Vérification des refus, sans exceptions.
echo '=== COHÉRENCE DES ASSOCIATIONS ===' . PHP_EOL;

$resultat = $neree->ajouterDrone($ner01);
echo 'Second ajout du même drone dans Nérée : ';
echo $resultat ? 'accepté' : 'refusé';
echo PHP_EOL;

$resultat = $calypso->ajouterDrone($ner01);
echo 'Ajout de NER-01 dans Calypso : ';
echo $resultat ? 'accepté' : 'refusé';
echo PHP_EOL;

$resultat = $ner01->ajouterObservation($observation1);
echo 'Second ajout de la même observation dans NER-01 : ';
echo $resultat ? 'accepté' : 'refusé';
echo PHP_EOL;

$resultat = $ner02->ajouterObservation($observation1);
echo 'Ajout de l’observation de NER-01 dans NER-02 : ';
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

// 6. Parcours depuis une observation jusqu'à sa station.
echo PHP_EOL . '=== ORIGINE D’UNE OBSERVATION ===' . PHP_EOL;

$droneOrigine = $observation1->getDrone();
$stationOrigine = $droneOrigine->getStation();

echo 'Découverte : ' . $observation1->getDescription() . PHP_EOL;
echo 'Drone : ' . $droneOrigine->getIdentifiant() . PHP_EOL;
echo 'Station : ' . $stationOrigine->getNom() . PHP_EOL;