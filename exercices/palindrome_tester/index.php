<?php

/**
 * Created by : Jonathan Istace
 * @usermail: jonathan.istace@proximus.be
 * @description: Demande à l'utilisateur d'entrée un mot ou une phrase et vérifie si le texte est un palindrome
 * @param : Entrée utilisateur d'un mot ou d'une phrase à tester
 * @return: Message de confirmation s'il s'agit d'un palindrome
 */

echo "\33[34mBienvenue sur notre testeur de palindrome" . "\n";
$mot_a_tester = readline("Quel mot/phrase souhaitez-vous tester: ");
echo "\33[0m";

// Traitement de la chaine de caractères:
// Conversion des caractères accentués en caractères non accentués (en UTF-8):
$accents = array('À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'à', 'á', 'â', 'ã', 'ä', 'å', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ð', 'ò', 'ó', 'ô', 'õ', 'ö', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ');
$remplacements = array('A', 'A', 'A', 'A', 'A', 'A', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 'a', 'a', 'a', 'a', 'a', 'a', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y');
$mot_sans_accents = str_replace ($accents, $remplacements, $mot_a_tester);

// Suppression des espaces et caractères spéciaux (utile pour analyser des phrases écrites en palindrome) expl: Élu par cette crapule:
$mot_sans_espace = preg_replace('/[^A-Za-z0-9\-]/', '', $mot_sans_accents);
// suppression des majuscules

// Remplacement des majuscules:
$texte = strtolower($mot_sans_espace);

// Vérification du texte
// Message en vert si OK, message en rouge si pas OK

$message = "\33[32mC'est bien un palindrome\33[0m";
$longueur = strlen($texte);

// On parcours le texte en comparant les extrémités, si pas de correspondance: on arrête
// On change la valeur du message à afficher si ce n'est pas un palindrome

for ($i=0; $i <= $longueur/2; $i++) {
    if ($texte[$i] != $texte[$longueur-1-$i]) {
        $message="\33[31mCe n'est pas un palindrome\33[0m";
        break;
    }
}

echo $message;
