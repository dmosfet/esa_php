<?php
include('../function.php');

// On récupère les données du formulaire envoyées depuis ../form/modifycardform.php
$formcolors = $_POST;

// On supprime l'input "submit" du formulaire reçu
unset($formcolors['submit']);

$newcolor = [];
$updatedcolors = [];

foreach ($formcolors as $key => $value) {
    $newkeys = explode("/", $key);
    $newcolor['balise'] = str_replace('_', '.', $newkeys[0]);
    $newcolor['attribut'] = $newkeys[1];
    $newcolor['color'] = $value;
    $updatedcolors[] = $newcolor;
}

// On réécrit la mise à jour dans le fichier CSV
$msg = "Modification impossible";

if (csvfromarray($updatedcolors, '../model/colortheme.csv')) {
    $msg = "Modification réalisée";
}

$msg = urlencode($msg);

// On retourne en mode vue pour afficher les changements
header('Location: ../index.php?mode=settings&msg=' . $msg);