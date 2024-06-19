<?php ob_start();
require("../function.php");


// On récupère les données du formulaire envoyées depuis ../form/modifycardform.php
$updatedtask = $_POST;
$number = $updatedtask['number'];

// On supprime l'input "submit" du formulaire reçu
unset($updatedtask['submit']);

// On recherche les données originales de la tâche à modifier
// On récupère toutes les tâches déjà encodées
$alltasks = arrayfromcsv("../model/tasks.csv");


foreach ($alltasks as $task) {
    if ($task['number'] == $updatedtask['number']) {
        $oldvaluetask = $task;
        break;
    }
}


// On recast les dates en int même si pas modifié
$updatedtask['creation'] = !(empty($updatedtask['creation'])) ? strtotime($updatedtask['creation']) : '';
$updatedtask['start'] = !(empty($updatedtask['start'])) ? strtotime($updatedtask['start']) : '';
$updatedtask['due'] = !(empty($updatedtask['due'])) ? strtotime($updatedtask['due']) : '';
$updatedtask['closed'] = !(empty($updatedtask['closed'])) ? strtotime($updatedtask['closed']) : '';
$updatedtask['cancelled'] = !(empty($updatedtask['cancelled'])) ? strtotime($updatedtask['cancelled']) : '';


// On transforme l'array tags reçues en un string séparé par une virgule'
if (!(empty($updatedtask['tags']))) {
    $updatedtask['tags'] = implode(",", $updatedtask['tags']);
} else {
    $updatedtask['tags'] = "";
}

// Vérification de cohérence des dates, on arrête les vérifications à la première incohérence

$start = $updatedtask['start'];
$due = $updatedtask['due'];
$closed = $updatedtask['closed'];
$cancelled = $updatedtask['cancelled'];

$errors = checksondate($start, $due, $closed, $cancelled);


// On réalise des vérifications avant de réécrire
//On initialise une variable $checked à true. On la change en false si on trouve une incohérence
if (!($errors)) {
    if ((empty($oldvaluetask['start'])) and !(empty($updatedtask['start']))) {
        $updatedtask['status'] = "1";
    }
    if ((empty($oldvaluetask['closed'])) and !(empty($updatedtask['closed']))) {
        $updatedtask['status'] = "2";
    }
    if ((empty($oldvaluetask['cancelled'])) and !(empty($updatedtask['cancelled']))) {
        $updatedtask['status'] = "3";
    }
    $alltasks[array_search($oldvaluetask, $alltasks)] = $updatedtask;
    csvfromarray($alltasks, '../model/tasks.csv');
    $msg = "Modification réalisée";
    $msg = urlencode($msg);

    // On notifie si un utilisateur est renseigné
    if ($oldvaluetask['user'] != null) {
        $allnotifications = readcsv('../model/notification.csv');
        $nextidnotification = nextnumber($allnotifications);

        $newnotification = [$nextidnotification, time(), "Une de vos tâche a été modifiée", $updatedtask['number'], $oldvaluetask['user'], "0"];
        addnewnotification($newnotification);
    }

    header('Location: ../index.php?mode=cardviewer&task=' . $number . '&msg=' . $msg);
} else {
    foreach ($errors as $error) {
        $errorlist[] = $error[1];
    }
    $msg = urlencode(implode(',', $errorlist));

    header('Location: ../index.php?mode=cardmodifyer&task=' . $number . '&msg=' . $msg);
}