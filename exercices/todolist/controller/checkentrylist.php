<?php ob_start();
include("../function.php");

$number = $_GET['task'];
$entryname= urldecode($_GET['entry']);

$allentrylist = arrayfromcsv('../model/minitasklist.csv');

foreach ($allentrylist as $key => $entry) {
    if ($entry['task'] == $number) {
        if ($entry['name'] == $entryname) {
            if ($entry['status'] == 0) {
                $allentrylist[$key]['status']="1";
            } else {
                $allentrylist[$key]['status']="0";
            }
        }
    }
    unset($entry);
}

// réécrit le fichier csv
if (csvfromarray($allentrylist,'../model/minitasklist.csv')) {
    $msg = "La tâche a été validée/invalidée";
}

$msg = urlencode($msg);
header('Location: ../index.php?mode=cardviewer&task='.$number.'&msg='.$msg);
