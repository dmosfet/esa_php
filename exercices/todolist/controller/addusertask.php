<?php ob_start();
require("../function.php");

$idtask = $_POST['tasknumber'];
$usertofind = $_POST['user'];

$allusers = arrayfromcsv("../model/users.csv");
$iduser = -1;

foreach ($allusers as $user) {
    $userfullname = $user['firstname'] . " " . $user['lastname'];
    if ($userfullname == $usertofind) {
        $iduser = $user['id'];
        break;
    }
}

// On récupère les données de la tâche à modifier
$alltasks = arrayfromcsv("../model/tasks.csv");
$tasktomodify = findtask($alltasks, $idtask);

// On change la valeur user de la tâche
$updatedtask = $tasktomodify;
$updatedtask['user'] = $iduser;

$alltasks[array_search($tasktomodify, $alltasks)] = $updatedtask;
csvfromarray($alltasks, '../model/tasks.csv');
$msg = "Modification réalisée";
$msg = urlencode($msg);

// On log le changement pour les notifications
$allnotifications = readcsv('../model/notification.csv');
$nextidnotification = nextnumber($allnotifications);

$newnotification = [$nextidnotification, time(), "Une nouvelle tâche vous a été attribuée", $idtask, $iduser, "0"];
addnewnotification($newnotification);

header('Location: ../index.php?mode=cardviewer&task=' . $idtask . '&msg=' . $msg);
