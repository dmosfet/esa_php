<?php
include('../function.php');

// On récupère les données du formulaires

$number = isset($_POST['number']) ? $_POST['number'] : '1';
$name = isset($_POST['name']) ? $_POST['name'] : '';
$description = isset($_POST['description']) ? $_POST['description'] : '';
$status = isset($_POST['status']) ? $_POST['status'] : '0';
$old_status = isset($_POST['old_status']) ? $_POST['old_status'] : '0';
$creation = !(empty($_POST['creation'])) ? strtotime($_POST['creation']) : $today = time();
$start = !(empty($_POST['start'])) ? strtotime($_POST['start']) : '';
$due = (!(empty($_POST['due']))) ? strtotime($_POST['due']) : '';
$closed = (!(empty($_POST['closed']))) ? strtotime($_POST['closed']) : '';
$cancelled = (!(empty($_POST['cancelled']))) ? strtotime($_POST['cancelled']) : '';
$tags = isset($_POST['tags']) ? implode(",", $_POST['tags']) : '';

// On vérifie si une tâche porte déjà ce nom

$alltasks = arrayfromcsv('../model/tasks.csv');

$exist = false;

foreach ($alltasks as $task) {
    echo $task['name'];
    if ($task['name'] == $name) {
        $exist = true;
        break;
    }
}

if ($exist) {
    $msg = "Une tâche portant ce nom existe déjà";
    header('Location: ../index.php?mode=addcard&task=' . $number . '&msg=' . urlencode($msg));
} else {
    $newligne = [$number, $name, $description, $status, $old_status, $creation, $start, $due, $closed, $cancelled, $tags];
    $errors = checksondate($start, $due, $closed, $cancelled);
}

$msg = 'Impossible de créer cette nouvelle tâche';

if ($errors) {
    foreach ($errors as $error) {
        $errorlist[] = $error[1];
    }
    $msg = urlencode(implode(',', $errorlist));
    header('Location: ../index.php?mode=addcard&task=' . $number . '&msg=' . $msg);
} else {
    if (addnewtask($newligne)) {
        $msg = "Ajout de la nouvelle tâche";
    }
    $msg = urlencode($msg);
    header('Location: ../index.php?mode=cardviewer&task=' . $number . '&msg=' . $msg);
}