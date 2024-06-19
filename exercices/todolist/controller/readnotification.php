<?php ob_start();
include("../function.php");

$id = $_GET['id'];
$allnotification = arrayfromcsv('../model/notification.csv');

foreach ($allnotification as $key => $notif) {
    if ($notif['id'] == $id) {
        $task = $notif['idtask'];
        if ($notif['status'] == 1) {
            break;
        } else {
            $allnotification[$key]['status'] = "1";
        }
    }
}

//réécrit le fichier csv
if (csvfromarray($allnotification, '../model/notification.csv')) {
    header('Location: ../index.php?mode=cardviewer&task=' . $task);
} else {
    header('Location: ../index.php?mode=notification');
}