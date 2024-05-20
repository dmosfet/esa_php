<?php

$number = isset($_POST['number']) ? $_POST['number'] : '1';
$name = isset($_POST['name']) ? $_POST['name'] : '';
$status = isset($_POST['status']) ? $_POST['status'] : '0';
$old_status = isset($_POST['old_status']) ? $_POST['old_status'] : '0';
$creation = isset($_POST['creation']) ? $_POST['creation'] : $today = date("Ymd");;
$start = isset($_POST['start']) ? $_POST['start'] : '0';;
$due = isset($_POST['due']) ? $_POST['due'] : '0';
$closed = isset($_POST['closed']) ? $_POST['closed'] : '0';
$canceled = isset($_POST['canceled']) ? $_POST['canceled'] : '0';
$tags = isset($_POST['tags']) ? $_POST['tags'] : '0';


$newligne = [$number,$name, $status,$old_status, $creation, $start, $due, $closed, $canceled, $tags];

$msg = "Ajout nok";
if (addnewtask ($newligne)) {
    $msg = "Ajout avec succès";
}

header('Location: ../view/card.php?task='.$number.'&msg='.$msg);


function addnewtask ($task):bool {
    $fp = fopen('../tasks.csv', 'a');
    fputcsv($fp,$task );
    fclose($fp);
    return true;
}

