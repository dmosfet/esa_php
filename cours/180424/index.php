<?php

/* Lecture d'un flux entrant du terminal
// $nom = readline ("Quel est ton nom ?")
// echo $nom;

// Lecture d'un argument
$nom = $argv[1];
echo $nom;

//Impression des arguments;
var_dump($argv);

*/

/**
 * Created by Jonathan Istace
 * Cette fonction simule une calculatrice. L'utilisateur doit d'abord choisir l'opérateur à utiliser.
 * Ensuite, il doit entrez 2 chiffres pour réaliser l'opération.
 */

$operateurs = array("+","-","/","*","^","%");

// Demande à l'utilisatur de sélectionner l'opérateur à utiliser.
do {
    $operateur = readline("Quelle opération souhaitez-vous réaliser ? (+, -, /, *, %,^) :  ");
} while (!in_array($operateur, $operateurs));

// Demande à l'utilisateur d'entrez le premier chiffre. Si pas castable, on recommence.
do {
    $a = readline ("Premier chiffre:  ");
} while (is_numeric($a) == false);

// Demande à l'utilisateur d'entrez le second chiffre. Si pas castable, on recommence.
do {
    $b = readline ("Second chiffre:  ");
} while (is_numeric($b) == false);

// Récupère les fonctions de la calculatrice
require_once ('calculatrice.inc.php');

switch ($operateur) {
    case "+":
        somme($a, $b);
        break;
    case "-":
        soustraction($a,$b);
        break;
    case "/":
        division($a,$b);
        break;
    case "*":
        multiplication($a,$b);
        break;
    case "^":
        exposant($a, $b);
        break;
    case "%":
        modulo($a, $b);
        break;
    default:
        echo 'Opérateur invalide';
}


