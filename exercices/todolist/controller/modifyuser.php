<?php ob_start();
require("../function.php");


// On récupère les données du formulaire envoyées depuis ../form/modifyuserform.php
$updateduser = $_POST;
$id = $updateduser['id'];

// On supprime l'input "submit" du formulaire reçu
unset($updateduser['submit']);

// On recherche les données originales de l'utilisateur à modifier
// On récupère toutes les tâches déjà encodées
$allusers = arrayfromcsv("../model/users.csv");
foreach ($allusers as $user) {
    if ($user['id'] == $updateduser['id']) {
        $oldvalueuser = $user;
        break;
    }
}

// On réalise des vérifications avant de réécrire
//On initialise une variable $checked à true. On la change en false si on trouve une incohérence

$allusers[array_search($oldvalueuser, $allusers)] = $updateduser;
csvfromarray($allusers, '../model/users.csv');
$msg = "Modification réalisée";
$msg = urlencode($msg);

header('Location: ../index.php?mode=user&msg=' . $msg);
