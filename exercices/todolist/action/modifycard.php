<?php ob_start()?>
<!doctype html>
<html lang="fr" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tâche</title>
</head>
<body>
<?php
include("../function.php");

// On récupère les données du formulaire envoyées depuis ../form/modifycardform.php
$updatedtask = $_POST;

// On supprime l'input "submit" du formulaire reçu
unset($updatedtask['submit']);

var_dump($updatedtask);

// On recherche les données originales de la tâche à modifier
// On récupère toutes les tâches déjà encodées
$alltasks = arrayfromcsv("../tasks.csv");

foreach ($alltasks as $task) {
    if ($task['number'] == $updatedtask['number']) {
        $oldvaluetask = $task;
        break;
    }
}

// On vérifie si la données est mise à jour
if ($updatedtask['start'] != $oldvaluetask['start']) {
    // On converti les dates du formulaire en JJ-MM-YYYY si non vide
    $updatedtask['start'] = !(empty($updatedtask['start'])) ? stringdatereverse($updatedtask['start']) : '';
    }
if ($updatedtask['due'] != $oldvaluetask['due']) {
    // On converti les dates du formulaire en JJ-MM-YYYY si non vide
    $updatedtask['due'] = !(empty($updatedtask['due'])) ? stringdatereverse($updatedtask['due']) : '';
}
if ($updatedtask['closed'] != $oldvaluetask['closed']) {
    // On converti les dates du formulaire en JJ-MM-YYYY si non vide
    $updatedtask['closed'] = !(empty($updatedtask['closed'])) ? stringdatereverse($updatedtask['closed']) : '';
}
if ($updatedtask['cancelled'] != $oldvaluetask['cancelled']) {
    // On converti les dates du formulaire en JJ-MM-YYYY si non vide
    $updatedtask['cancelled'] = !(empty($updatedtask['cancelled'])) ? stringdatereverse($updatedtask['cancelled']) : '';
}

// On transforme l'array tags reçues en un string séparé par une virgule'
if (!(empty($updatedtask['tags']))) {
    $updatedtask['tags'] = implode(",", $updatedtask['tags']);
} else {
    $updatedtask['tags'] = "";
}

// On réalise des vérifications avant de réécrire
//On initialise une variable $checked à true. On la change en false si on trouve une incohérence
$checked = true;

if ((empty($oldvaluetask['start']))  and !(empty($updatedtask['start']))) {
    $updatedtask['status'] = "1";
}

if ($updatedtask['due'] !="" && $updatedtask['due'] < $updatedtask['start']) {
    $checked = false;
}

// Si la vérification s'est bien passée, on remplace l'ancienne tâche par la nouvelle
// dans la liste de toutes les tâches en se basant sur sa position
if ($checked) {
    $alltasks[array_search($oldvaluetask, $alltasks)] = $updatedtask;

    // On réécrit la liste des tâches mise à jour dans le fichier CSV
    csvfromarray($alltasks,'../tasks.csv');

    $msg = "Modification réalisée";
} else {
    $msg = "Modification annulée";
}

$msg = urlencode($msg);

// On retourne en mode vue pour afficher les changements
header('Location: ../view/card.php?task='.$updatedtask['number'].'&msg='.$msg);
?>
</body>
</html>

