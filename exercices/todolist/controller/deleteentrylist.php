<?php ob_start();
include("../function.php");

$number = $_GET['entry'];

$allentrylist = arrayfromcsv('../model/minitasklist.csv', $number);

foreach ($allentrylist as $entry) {
        if ($entry['id'] == $number) {
            $entrytodelete = $entry;
            $task = $entry['task'];
            break;
        }
}

// retourne la position de la tâche dans la liste
$position = array_search($entrytodelete, $allentrylist);
// On garde le nom du fichier pour la suppression

unset($allentrylist[$position]);

// réécrit le fichier csv
$msg = "L'entrée n'a pu être supprimé";

if (csvfromarray($allentrylist,'../model/minitasklist.csv')) {
    $msg = "L'entrée a été supprimé";
}

$msg = urlencode($msg);
header('Location: ../index.php?mode=cardviewer&task='.$task.'&msg='.$msg);