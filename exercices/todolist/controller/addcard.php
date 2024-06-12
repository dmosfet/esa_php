<?php

include('../function.php');
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

$newligne = [$number, $name, $description, $status, $old_status, $creation, $start, $due, $closed, $cancelled, $tags];

$msg = 'Impossible de créer cette nouvelle tâche';

$errors = checksondate($start, $due, $closed, $cancelled);

if ($errors) {
    foreach ($errors as $error) {
        $errorlist[] = $error[1];
    }
    $msg = urlencode(implode(',', $errorlist));
    header('Location: ../index.php?mode=addcard.php&task=' . $number . '&msg=' . $msg);
} else {
    if (addnewtask($newligne)) {
        $msg = "Ajout de la nouvelle tâche";
    }
    $msg = urlencode($msg);
    header('Location: ../index.php?mode=cardviewer&task=' . $number . '&msg=' . $msg);
}