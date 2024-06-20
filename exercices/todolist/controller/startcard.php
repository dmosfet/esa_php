<?php ob_start();
include("../function.php");

$number = $_GET['task'];
$allstasks = arrayfromcsv("../model/tasks.csv");

// retourne les valeurs complètes de la tâches qu'on démarre.
$tasktostart = findtask($allstasks, $number);

// retourne la position de la tâche dans la liste
$position = array_search($tasktostart, $allstasks);

// update la valeur orginal puis update la liste via son index
$tasktostart['status'] = 1;
$tasktostart['start'] = time();
$allstasks[$position] = $tasktostart;

// réécrit le fichier csv
$msg = "La tâche n'a pu être démarée";
if (csvfromarray($allstasks, '../model/tasks.csv')) {
    $msg = "La tâche a démarré";
}
$msg = urlencode($msg);
header('Location: ../index.php?mode=cardviewer&task=' . $number . '&msg=' . $msg);