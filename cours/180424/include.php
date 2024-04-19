<?php

$a = "Bonjour, tout le monde";

echo 'valeur de $a avant la biliotheque : ' . $a . '<br>';

include ('bibliotheque.inc.php');

echo 'valeur de $a après la biliotheque : ' . $a . '<br>';
