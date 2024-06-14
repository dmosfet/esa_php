<?php ob_start();
include("../function.php");
$number = $_GET['task'];
$allstasks = arrayfromcsv("../model/tasks.csv");

// retourne les valeurs complètes de la tâches qu'on démarre.
$tasktocancel=findtask($allstasks, $number);

// retourne la position de la tâche dans la liste
$position = array_search($tasktocancel, $allstasks);

// update la valeur orginal puis update la liste via son index
$tasktocancel['status'] = -1;
$allstasks[$position] = $tasktocancel;

// réécrit le fichier csv
$msg = "La tâche n'a pu être supprimée";
if (csvfromarray($allstasks,'../model/tasks.csv')) {
    $msg = "La tâche a été supprimée";
}

$msg = urlencode($msg);
header('Location: ../index.php?mode=cardviewer&task='.$number.'&msg='.$msg);