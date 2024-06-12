<?php ob_start();

include('../function.php');

$name = strtolower($_POST['name'] ?? '');
$alltasks = arrayfromcsv('../model/tasks.csv');
$idfindedtask = "";

foreach ($alltasks as $task) {
    if (str_contains(strtolower($task['name']), $name)) {
        $idfindedtask .= $task['number'] . ";";
    }
}

header('Location: ../index.php?mode=find&tasks='.$idfindedtask);
