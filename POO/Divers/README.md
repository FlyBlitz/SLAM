# Projet Intro POO - Simulation d'un Robot

Projet pédagogique d'introduction à la Programmation Orientée Objet (BTS SIO).

---

## Objectif du projet

Ce projet a pour but de modéliser une petite entité (**un robot**) et de comparer deux paradigmes de programmation :
1. **L'approche procédurale** (étape actuelle) : les données sont stockées dans un tableau associatif et manipulées via des fonctions avec passage par référence.
2. **L'approche orientée objet** (étape suivante) : refactorisation sous forme de classe (`Robot`) encapsulant les attributs (nom, énergie) et les méthodes (`jouer()`, `recharger()`, etc.).

Cette première version permet de manipuler la gestion d'état et les règles métier en procédural, tout en constatant les limites qui motivent le passage à la POO (absence d'encapsulation réelle, manipulation de variables globales, gestion manuelle des structures).

---

## Règles de gestion (RG)

### 1. Attributs et création du robot (`creerRobot`)
- Un robot est caractérisé par un **nom** (chaîne de caractères) et un niveau d'**énergie** (entier).
- **Règles de validation à la création** :
  - Le nom ne doit pas être vide, ne doit pas contenir d'espaces et doit comporter au moins **3 caractères**.
  - L'énergie initiale doit être comprise entre **0 et 100 unités** (valeur par défaut : 100).
  - En cas de non-respect des règles, la fonction retourne `null` (gestion d'erreur classique sans exception).
- L'énergie est exprimée en **unités d'énergie**.
- Le niveau d'énergie reste toujours compris entre **0** (minimum) et **100** (maximum).

### 2. Action « Jouer » (`jouer`)
- **Condition requise** : Le robot doit disposer d'au moins **20 unités d'énergie** pour pouvoir jouer.
- **Succès** : Si l'énergie est suffisante ($\ge 20$), le robot perd **20 unités d'énergie** et la fonction retourne `true`.
- **Échec** : Si l'énergie est strictement inférieure à 20, le robot ne peut pas jouer, son énergie reste inchangée et la fonction retourne `false`.

### 3. Action « Recharger » (`recharger`)
- **Validation** : La quantité d'énergie à ajouter doit être **strictement positive** ($> 0$).
  - Si la quantité est négative ou nulle ($\le 0$), la recharge échoue et la fonction retourne `false`.
- **Plafonnement** : L'énergie maximale du robot est de **100 unités**. L'ajout est limité à la capacité restante disponible afin de ne jamais dépasser ce plafond.
- **Succès** : L'énergie est augmentée et la fonction retourne `true`.

### 4. Consultation des données
- `obtenirNom($robot)` : retourne le nom du robot.
- `obtenirEnergie($robot)` : retourne le niveau actuel d'énergie.



