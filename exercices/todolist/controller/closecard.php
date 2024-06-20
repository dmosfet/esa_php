<?php ob_start();
include("../function.php");

$number = $_GET['task'];
$allstasks = arrayfromcsv("../model/tasks.csv");

// retourne les valeurs complètes de la tâches qu'on démarre.
$tasktoclose=findtask($allstasks, $number);

// retourne la position de la tâche dans la liste
$position = array_search($tasktoclose, $allstasks);

// update la valeur orginal puis update la liste via son index
$tasktoclose['old_status'] = $tasktoclose['status'];
$tasktoclose['status'] = 2;
$tasktoclose['closed'] = time();
$allstasks[$position] = $tasktoclose;

$checked = true;

if (empty($tasktoclose['start'])) {
    $msg = "La tâche n'a pas débutée";
    $checked = false;
}

// réécrit le fichier csv

if ($checked) {
    if (csvfromarray($allstasks,'../model/tasks.csv')) {
        $msg = "La tâche a été clôturée";
    }
}
$msg = urlencode($msg);
header('Location: ../index.php?mode=cardviewer&task='.$number.'&msg='.$msg);