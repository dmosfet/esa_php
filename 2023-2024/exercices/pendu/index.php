<?php

/**
 * @author Jonathan Istace<jonathan.istace@proximus.be>
 * @category Games
 * @description Un simple pendu basé sur une liste de mots (en majuscules) stockés dans un fichier mots.txt
 */

// On charge dans une array les mots que le programme peut utiliser (se trouve dans un fichier: mots.txt).
//Et on n'oublie pas de ne pas prendre en compte les \n en fin de lignes
$liste_mots = file('mots.txt', FILE_IGNORE_NEW_LINES);

// On sélectionne au hasard un mot dans cette liste
$motachercher = $liste_mots[array_rand($liste_mots)];

// On importe les dessins du jeu
require './dessin.php';

// On affiche le titre:
echo $titre;

// On attend que l'utilisateur lance une partie
pause();

// On commence la partie en intialisant les différentes variables du jeu
$lettresdejaproposées = "";
$nbrerreurspossibles = 8;

// On crée une variable $resultat qui comprendre les caractères du mot remplacé par des "_"
$longueur = strlen($motachercher);
$resultat = "";

for ($i=1; $i <= $longueur; $i++) {
    $resultat .= "_";
}

// On créé une boucle qui se termine soit quand le nombre d'erreurs est à 0 soit quand le mot est trouvé

while ($nbrerreurspossibles>0 AND $motachercher!==$resultat) {

    // On imprime le dessin de l'échaffaud
    echo dessinPendu($nbrerreurspossibles);
    echo "\n";

    // On affiche le resultat (juste des tirets au début du jeu)
    echo "Quel est ce mot: ";
    printLettreEspace($resultat);
    echo "\n";

    // On affiche les lettres déjà proposées
    echo "Lettres déjà proposées: ";
    afficheLettreProposée ($lettresdejaproposées);

    // On demande à l'utilisateur de proposer une lettre
    $proposition = strtoupper(readline("Entree votre proposition de lettre: "));
    while (strlen($proposition) > 1) {
        $proposition = strtoupper(readline("Une seule lettre, svp: "));
    }


    // On vérifie si la proposition a déja été faite
    if (str_contains($lettresdejaproposées, $proposition)) {
        echo "Cette lettre a déjà été proposée";
    } else {
        $lettresdejaproposées .= $proposition;
        // On vérifie ensuite si la lettre est présente dans le mot à chercher
        $trouve = str_contains($motachercher, $proposition);
        if ($trouve) {
            echo "Bravo !\n";
            $resultat = afficheLettreTrouvee($motachercher, $resultat, $proposition);
        } else {
            echo "Ce mot ne contient pas cette lettre \n";
            $nbrerreurspossibles--;
        }
    }
}

if ($nbrerreurspossibles ==0) {
    echo "\33[31m";
    echo "Vous avez perdu !!!\n";
    echo "Le mot à trouver était: " . $motachercher;
    echo "\33[0m";
} else {
    echo "\33[32m";
    echo "Vous avez gagné !!!";
    echo "\33[0m";
}

/**
 * Simple fonction qui met sur pause le programme tant que l'utilisateur n'appuye pas sur ENTER
 * @return false|string : false tant que l'utilisateur n'a pas appuyer sur ENTER
 */
function pause()
{
    $handle = fopen("php://stdin", "r");
    echo "Appuyer sur ENTER pour lancer une partie";
    do {
        $line = fgets($handle);
    } while ($line == '');
    fclose($handle);
    return $line;
}

/**
 * Simple fonction qui imprime un mot lettre par lettre en ajoutant un espace
 * @param $texte
 * @return void
 */
function printLettreEspace ($texte) {
    $nbrlettres = strlen($texte);
    for ($i=0; $i < $nbrlettres; $i++) {
        echo $texte[$i] . " ";
    }
}

/**
 * Recherche la position d'une lettre dans un string, la copie à la même position d'une autre string de même taille
 * @param $motaveclettrecherchee : mot qui contient la lettre dont on cherche la position dans le mot
 * @param $motaveclettrerecopiee : mot dans lequel on recopie cette lettre
 * @param $lettre : lettre que l'on cherche à recopier
 * @return String $motaveclettrerecopiee
 */
function afficheLettreTrouvee ($motaveclettrecherchee, $motaveclettrerecopiee, $lettre) : String {
    $nbrlettres = strlen($motaveclettrecherchee);
    for ($i=0; $i < $nbrlettres; $i++) {
        if ($motaveclettrecherchee[$i] == $lettre) {
            $motaveclettrerecopiee[$i] = $lettre;
        }
    }
    return $motaveclettrerecopiee;
}

/**
 * Imprime les lettres d'un mot triées par ordre alphabétique
 * @param $lettres: mot à afficher lettre par lettre triée
 * @return void
 */
function afficheLettreProposée($lettres)
{
    $arraylettres = str_split($lettres);
    sort($arraylettres);
    foreach ($arraylettres as $lettre) {
        echo $lettre .", ";
    }
    echo "\n";
}

