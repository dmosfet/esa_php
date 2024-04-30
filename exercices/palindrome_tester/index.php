<?php

/**
 * @author : Jonathan Istace <jonathan.istace@proximus.be
 * @description: Demande à l'utilisateur d'entrer un mot ou une phrase et vérifie si le texte est un palindrome
 * @param : String mot_a_tester
 * @return: Message de confirmation s'il s'agit d'un palindrome
 */

echo "\33[34m";
echo "Bienvenue sur notre testeur de palindrome" . "\n";
$mot_a_tester = readline("Quel mot/phrase souhaitez-vous tester: ");
echo "\33[0m";

// Traitement de la chaine de caractères:
// Conversion des caractères accentués en caractères non accentués (en UTF-8):
$mot_sans_accents = stripaccents($mot_a_tester);

// Suppression des espaces et caractères spéciaux (utile pour analyser des phrases écrites en palindrome) expl: Élu par cette crapule:
$mot_sans_caracteres_speciaux = preg_replace('/[^A-Za-z0-9\-]/', '', $mot_sans_accents);
// suppression des majuscules

// Remplacement des majuscules:
$texte = strtolower($mot_sans_caracteres_speciaux);

// Vérification du texte
// Message en vert si OK, message en rouge si pas OK

$message = "\33[32m";
$message .="C'est bien un palindrome !";
$message .= "\33[0m";
$longueur = strlen($texte);

// On parcours le texte en comparant les extrémités, si pas de correspondance: on arrête
// On change la valeur du message à afficher si ce n'est pas un palindrome

for ($i=0; $i <= $longueur/2; $i++) {
    if ($texte[$i] != $texte[$longueur-1-$i]) {
        $message = "\33[31m";
        $message .= "Ce n'est pas un palindrome !";
        $message .= "\33[0m";
        break;
    }
}

echo $message;

/**
 * Supprimer les accents d'une chaine de caractères sur base d'une liste de caractères de remplacements
 * intégrée à la fonction
 * @param $texte
 * @return string
 */
function stripaccents ($texte)
{
    $accents = ['À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'à', 'á', 'â', 'ã', 'ä', 'å', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ð', 'ò', 'ó', 'ô', 'õ', 'ö', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ'];
    $remplacements = ['A', 'A', 'A', 'A', 'A', 'A', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 'a', 'a', 'a', 'a', 'a', 'a', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y'];
    $resultat = str_replace($accents, $remplacements, $texte);
    return $resultat;
}
