<?php ob_start();
include("../function.php");

$number = $_GET['task'];
$allstasks = arrayfromcsv("../tasks.csv");

// retourne les valeurs complètes de la tâches qu'on démarre.
$tasktocancel = findtask($allstasks, $number);

// retourne la position de la tâche dans la liste
$position = array_search($tasktocancel, $allstasks);

copytasktodeletedtask($tasktocancel);

// supprime la tâche de la liste basée sur son index
unset($allstasks[$position]);

// réécrit le fichier csv
$msg = "La tâche n'a pas pu être supprimée";
if (csvfromarray($allstasks, '../tasks.csv')) {
    $msg = "La tâche a été supprimée";
}
$msg = urlencode($msg);
header('Location: ../view/recycle.php?msg=' . $msg);
