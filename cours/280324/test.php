<?php
$livres = [
    ["titre" => "Le banquet", "auteur" => "Platon", "origine" => "Grèce", "type" => "philosophie"],
    ["titre" => "Harry Potter et le prisonnier d'Azkaban", "auteur" => "J.K. Rowling", "origine" => "Royaume-Uni", "type" => "fantastique"],
    ["titre" => "Fondation", "auteur" => "Isaac Asimov", "origine" => "Russie", "type" => "philosophie"]
];
echo '<pre>';
var_dump($livres);
echo '<pre>';

// Impression du premier livre du tableau de livres
echo "L'ouvrage est de " . $livres[0]["auteur"] . "<br>";
echo "et s'intitule : " . $livres[0]["titre"];
echo "<hr>";

print_r($livres);


echo "--------------------------------------------------------------------------------------------------" . "\n\n";
// Casting automatique de PHP
$a = "3" + 1;
echo '"3" + 1 = ' . $a . "<br>";
// résultat: 4

/*
$a = "bonjour" + 1;
echo '"bonjour" + 1 = ' . $a . "<br>";
// résultat: error
*/

$a = "1 petit canard" + 2;
echo '"1 petit canard" + 2 = ' . $a . "<br>";
// résultat: 3

$a = TRUE;
echo 'TRUE = '. $a . ".<br>";
// résultat: true

$a = FALSE;
echo 'FALSE = '. $a . ".<br>";
// résultat : chaine vide


echo "--------------------------------------------------------------------------------------------------" . "\n\n";
// Casting forcé des variables
$a = "3" + 1;
echo '"3" + 1 : ' . gettype($a) . ", " .$a . "<br>";
// résultat:

$a = (string) $a;
echo 'integer -> string : ' . gettype($a) . ", " .$a . "<br>";
// résultat:

$a = settype($a, 'boolean');
echo 'string -> boolean : ' . gettype($a) . ", " .$a . "<br>";
// résultat

$a = intval($a);
echo 'string -> integer : ' . gettype($a) . ", " .$a . "<br>";



echo "--------------------------------------------------------------------------------------------------" . "\n\n";
$a = 2;
$a = 2 + 3;
$a += 3;
echo $a++ . "<=>" . $a . "<br>";
echo ++$a . "<=>" . $a . "<br>";