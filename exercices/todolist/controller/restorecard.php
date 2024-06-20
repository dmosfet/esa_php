<?php
include("../function.php");

$number = $_GET['task'];

$allstasks = arrayfromcsv("../model/tasks.csv");

// retourne les valeurs complètes de la tâches qu'on démarre.
$tasktorestore = findtask($allstasks, $number);

// retourne la position de la tâche dans la liste
$position = array_search($tasktorestore, $allstasks);

// update la valeur orginal puis update la liste via son index
$tasktorestore['status'] = $tasktorestore['old_status'];
$tasktorestore['cancelled'] = "";
$tasktorestore['closed'] = "";
$allstasks[$position] = $tasktorestore;

// réécrit le fichier csv
$msg = "La tâche n'a pu être restaurée";
if (csvfromarray($allstasks, '../model/tasks.csv')) {
    $msg = "La tâche a été restaurée";
}

$msg = urlencode($msg);
header('Location: ../index.php?mode=cardviewer&task=' . $number . '&msg=' . $msg);