<?php

$tableau = array(2,4,6,8,"chien",'chat', 10);

foreach ($tableau as $value) {
    echo $value . "<br>";
}

$livre = array(
    "titre" => "Le Banquet",
    "auteur" => "Planton",
    "origine" => "Grèce",
    "type" => "philosophie");

echo " --------------------------------";

foreach ($livre as $clef => $valeur) {
    echo $clef . " : " . $valeur . "<br>";
}

foreach ($livre as $clef => &$valeur) {
    echo $clef . " : " . $valeur . "<br>";
}