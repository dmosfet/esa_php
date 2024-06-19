<?php ob_start();
include("../function.php");

$id = $_GET['id'];
$allnotification = arrayfromcsv('../model/notification.csv');

foreach ($allnotification as $key => $notif) {
    if ($notif['id'] == $id) {
        if ($notif['status'] == 0) {
            $allnotification[$key]['status'] = "1";
        } else {
            $allnotification[$key]['status'] = "0";
        }
        $task = $notif['idtask'];
    }
}

//réécrit le fichier csv
if (csvfromarray($allnotification, '../model/notification.csv')) {
    header('Location: ../index.php?mode=cardviewer&task=' . $task);
} else {
    header('Location: ../index.php?mode=notification');
}