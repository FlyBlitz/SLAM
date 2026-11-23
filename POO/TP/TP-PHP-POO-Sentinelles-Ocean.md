# TP PHP — Les sentinelles de l’océan

**BTS SIO — Programmation orientée objet**  
**Durée indicative :** 2 à 3 heures  
**Livrables :** Trois classes PHP et un programme principal `main.php` en mode console.

## 1. Le contexte

Une association scientifique surveille les fonds marins grâce à des stations sous-marines. Chaque station dispose de drones qui explorent les alentours et enregistrent des observations : animaux rares, épaves ou phénomènes géologiques.

Vous devez développer un prototype permettant de consulter les équipements de chaque station et les découvertes de chaque drone.

L’application comporte exactement trois classes : `Station`, `Drone` et `Observation`. Le programme principal est fourni à la fin du document ; les classes sont à réaliser.

## 2. Les règles de fonctionnement

### Les stations et les drones

Une station possède un nom et une zone maritime. Elle peut commencer son activité sans drone, puis en accueillir plusieurs.

Chaque drone possède un identifiant et une profondeur maximale d’exploration. Il appartient à une seule station, obligatoirement indiquée lors de sa construction. Ce rattachement est définitif.

### Les drones et les observations

Un drone peut ne posséder aucune observation ou en posséder plusieurs.

Une observation contient une description, une profondeur et un niveau d’intérêt scientifique. Elle provient d’un seul drone, obligatoirement indiqué lors de sa construction. Ce rattachement est définitif.

### La création et le rattachement

Tous les objets sont créés directement dans le programme principal avec `new` :

```php
$neree = new Station('Nérée', 'Fosse des Brumes');
$ner01 = new Drone('NER-01', 300, $neree);
$observation = new Observation('Méduse luminescente', 120, 4, $ner01);
```

Après ces trois instructions :

- le drone connaît sa station et figure déjà dans la collection des drones de cette station ;
- l’observation connaît son drone et figure déjà dans la collection des observations de ce drone.

**Le rattachement aux collections est automatique : il est déclenché par les constructeurs.** Le programme principal n’a pas à effectuer un second appel pour terminer l’association.

Aucune méthode de création telle que `creerDrone()` ou `creerObservation()` n’est demandée. Les méthodes d’ajout décrites plus loin reçoivent des objets qui existent déjà : elles ne les construisent pas.

## 3. Le périmètre et les contraintes

- Tous les attributs sont privés ; toutes les méthodes demandées sont publiques.
- Ne créez pas d’association directe entre `Station` et `Observation`.
- Réservez les affichages au fichier `main.php` : aucun `echo` dans les classes.
- Typez les propriétés, les paramètres et les valeurs de retour. Un constructeur ne porte pas de type de retour.

### Données valides à la construction

Pour concentrer le travail sur les associations, **les données transmises aux constructeurs sont supposées valides** :

- les noms, zones, identifiants et descriptions ne sont pas vides ;
- la profondeur maximale d’un drone est un entier strictement positif ;
- la profondeur d’une observation est un entier compris entre zéro et la profondeur maximale de son drone ;
- l’intérêt scientifique est un entier de 1 à 5 ;
- les identifiants des drones créés dans une même station sont distincts.

Il n’est pas demandé de contrôler ces valeurs dans les constructeurs ni de créer volontairement des objets avec des données invalides. Les contrôles à programmer concernent uniquement la cohérence des ajouts aux collections.

## 4. Mission 1 — Découvrir les associations

Avant de programmer, répondez aux questions suivantes à partir des règles de fonctionnement :

1. Pour une station donnée, combien de drones peut-on avoir au minimum et au maximum ?
2. Pour un drone donné, combien de stations peut-on avoir ?
3. Pour un drone donné, combien d’observations peut-on avoir au minimum et au maximum ?
4. Pour une observation donnée, combien de drones peuvent en être à l’origine ?
5. Quels parcours entre objets faut-il effectuer pour afficher toutes les observations d’une station ?

Réalisez ensuite le diagramme UML avec les trois classes, leurs attributs propres, leurs méthodes, les associations et toutes les multiplicités. Indiquez les sens de navigation permis par les méthodes.

**Convention UML :** lorsque les associations sont dessinées, ne recopiez pas dans les compartiments d’attributs les propriétés PHP qui représentent ces associations (`$drones`, `$station`, `$observations`, `$drone`). Elles restent nécessaires dans le code PHP.

## 5. Mission 2 — Développer la classe Station

### Attributs privés

| Attribut        | Type PHP | Rôle                                              |
| --------------- | -------- | ------------------------------------------------- |
| `$nom`          | `string` | Nom de la station                                 |
| `$zoneMaritime` | `string` | Zone maritime surveillée                          |
| `$drones`       | `array`  | Tableau des objets `Drone` rattachés à la station |

### Méthodes publiques

| Signature                                        | Comportement attendu                                              |
| ------------------------------------------------ | ----------------------------------------------------------------- |
| `__construct(string $nom, string $zoneMaritime)` | Initialise le nom, la zone et la collection vide                  |
| `getNom(): string`                               | Retourne le nom                                                   |
| `getZoneMaritime(): string`                      | Retourne la zone maritime                                         |
| `getDrones(): array`                             | Retourne le tableau des drones                                    |
| `getNombreDrones(): int`                         | Retourne le nombre de drones                                      |
| `ajouterDrone(Drone $drone): bool`               | Ajoute un drone existant si les règles ci-dessous sont respectées |

### Règles de ajouterDrone()

La méthode doit :

1. vérifier que la station retournée par `$drone->getStation()` est l’objet station courant ; sinon retourner `false` ;
2. vérifier que ce même objet drone n’est pas déjà présent dans la collection ; s’il est présent, retourner `false` ;
3. ajouter le drone puis retourner `true`.

En cas de refus, la collection reste inchangée. La méthode ne modifie pas la station du drone et ne crée aucun nouvel objet.

Pour comparer l’identité de deux objets, utilisez `===` ou `!==`. Pour rechercher un même objet dans un tableau, vous pouvez utiliser `in_array($objet, $tableau, true)` : le troisième argument active la comparaison stricte.

**Question :** pourquoi le test sur la station empêche-t-il d’ajouter le drone d’une autre station ?

## 6. Mission 3 — Développer la classe Drone

### Attributs privés

| Attribut              | Type PHP  | Rôle                                                      |
| --------------------- | --------- | --------------------------------------------------------- |
| `$identifiant`        | `string`  | Identifiant du drone                                      |
| `$profondeurMaximale` | `int`     | Profondeur maximale d’exploration, en mètres              |
| `$station`            | `Station` | Station du drone                                          |
| `$observations`       | `array`   | Tableau des objets `Observation` enregistrés par le drone |

### Méthodes publiques

| Signature                                                                     | Comportement attendu                                                                           |
| ----------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------- |
| `__construct(string $identifiant, int $profondeurMaximale, Station $station)` | Initialise tous les attributs puis inscrit automatiquement le drone dans sa station            |
| `getIdentifiant(): string`                                                    | Retourne l’identifiant                                                                         |
| `getProfondeurMaximale(): int`                                                | Retourne la profondeur maximale                                                                |
| `getStation(): Station`                                                       | Retourne l’objet station associé                                                               |
| `getObservations(): array`                                                    | Retourne le tableau des observations                                                           |
| `getNombreObservations(): int`                                                | Retourne le nombre d’observations                                                              |
| `ajouterObservation(Observation $observation): bool`                          | Ajoute une observation existante si les règles ci-dessous sont respectées                      |
| `getPlusGrandeProfondeurObservee(): ?int`                                     | Retourne la profondeur la plus élevée parmi les observations, ou `null` si le tableau est vide |

### Le constructeur

Le constructeur doit effectuer ces actions dans cet ordre :

1. initialiser l’identifiant et la profondeur maximale ;
2. mémoriser la station reçue en paramètre ;
3. initialiser la collection des observations ;
4. appeler la méthode `ajouterDrone()` de cette station en lui transmettant l’objet drone courant.

**À découvrir :** quelle expression permet de désigner l’objet courant depuis l’une de ses méthodes ? Pourquoi faut-il mémoriser sa station avant de l’inscrire dans la collection ?

### Règles de ajouterObservation()

La méthode doit :

1. vérifier que le drone retourné par `$observation->getDrone()` est l’objet drone courant ; sinon retourner `false` ;
2. refuser avec `false` l’ajout d’un même objet observation déjà présent ;
3. ajouter l’observation puis retourner `true`.

En cas de refus, la collection reste inchangée. La méthode ne change pas le drone de l’observation et ne construit aucun objet.

### Recherche de la profondeur maximale observée

`getPlusGrandeProfondeurObservee()` parcourt les observations pour trouver la profondeur la plus élevée.

Le type `?int` signifie « un entier ou `null` ». La méthode retourne `null` lorsque le drone ne possède aucune observation.

**Question :** pourquoi retourner zéro pour une collection vide serait-il ambigu, sachant qu’une observation à zéro mètre est autorisée ?

## 7. Mission 4 — Développer la classe Observation

### Attributs privés

| Attribut               | Type PHP | Rôle                                   |
| ---------------------- | -------- | -------------------------------------- |
| `$description`         | `string` | Description de la découverte           |
| `$profondeur`          | `int`    | Profondeur de la découverte, en mètres |
| `$interetScientifique` | `int`    | Niveau d’intérêt de 1 à 5              |
| `$drone`               | `Drone`  | Drone à l’origine de l’observation     |

### Méthodes publiques

| Signature                                                                                   | Comportement attendu                                                                    |
| ------------------------------------------------------------------------------------------- | --------------------------------------------------------------------------------------- |
| `__construct(string $description, int $profondeur, int $interetScientifique, Drone $drone)` | Initialise tous les attributs puis inscrit automatiquement l’observation dans son drone |
| `getDescription(): string`                                                                  | Retourne la description                                                                 |
| `getProfondeur(): int`                                                                      | Retourne la profondeur                                                                  |
| `getInteretScientifique(): int`                                                             | Retourne le niveau d’intérêt                                                            |
| `getDrone(): Drone`                                                                         | Retourne l’objet drone associé                                                          |

### Le constructeur

Le constructeur doit :

1. initialiser la description, la profondeur et le niveau d’intérêt ;
2. mémoriser le drone reçu en paramètre ;
3. appeler la méthode `ajouterObservation()` de ce drone en lui transmettant l’objet observation courant.

**Question :** pourquoi conserver un objet `Drone` dans l’observation plutôt que seulement l’identifiant du drone ?

## 8. Mission 5 — Utiliser le programme principal

Créez les fichiers `Station.php`, `Drone.php`, `Observation.php` et `main.php` dans un même dossier.

Le code ci-dessous est fourni intégralement. Vos classes doivent permettre son exécution sans modification. Ce script utilise les trois classes et affiche des résultats : ce ne sont pas des tests unitaires.

Les appels d’ajout de la partie 4 servent uniquement à vérifier le refus des doublons et des associations incohérentes. Les associations normales ont déjà été établies par les constructeurs.

### Code de main.php

```php
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
```

### Exécution en console

Ouvrez un terminal dans le dossier du projet, puis exécutez :

```bash
php main.php
```

### Résultats attendus

| Vérification                                     | Résultat attendu                       |
| ------------------------------------------------ | -------------------------------------- |
| Second ajout du même drone dans Nérée            | Refusé                                 |
| Ajout de NER-01 dans Calypso                     | Refusé                                 |
| Second ajout de la même observation dans NER-01  | Refusé                                 |
| Ajout de l’observation de NER-01 dans NER-02     | Refusé                                 |
| Nombre de drones de Nérée                        | 2                                      |
| Nombre de drones de Calypso                      | 1                                      |
| Nombre d’observations de NER-01                  | 2                                      |
| Nombre d’observations de NER-02                  | 1                                      |
| Nombre d’observations de CAL-01                  | 0                                      |
| Plus grande profondeur observée par NER-01       | 260 m                                  |
| Plus grande profondeur observée par NER-02       | 720 m                                  |
| Résultat pour CAL-01                             | `null`, affiché « Aucune observation » |
| Drone retrouvé depuis la première observation    | NER-01                                 |
| Station retrouvée depuis la première observation | Nérée                                  |
