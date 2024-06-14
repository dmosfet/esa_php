<?php ob_start();
include("../function.php");

$number = $_GET['entry'];

$allentrylist = arrayfromcsv('../model/minitasklist.csv');

foreach ($allentrylist as $key => $entry) {
    if ($entry['id'] == $number) {
        if ($entry['status'] == 0) {
            $allentrylist[$key]['status'] = "1";
        } else {
            $allentrylist[$key]['status'] = "0";
        }
        $task = $entry['task'];
    }
}


// réécrit le fichier csv
if (csvfromarray($allentrylist, '../model/minitasklist.csv')) {
    $msg = "La tâche a été validée/invalidée";
}

$msg = urlencode($msg);
header('Location: ../index.php?mode=cardviewer&task=' . $task . '&msg=' . $msg);
