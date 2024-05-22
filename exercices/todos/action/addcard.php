<?php

$number = isset($_POST['number']) ? $_POST['number'] : '1';
$name = isset($_POST['name']) ? $_POST['name'] : '';
$status = isset($_POST['status']) ? $_POST['status'] : '0';
$old_status = isset($_POST['old_status']) ? $_POST['old_status'] : '0';
$creation = isset($_POST['creation']) ? $_POST['creation'] : $today = date("d-m-Y");;
$start = isset($_POST['start']) ? $_POST['start'] : '';;
$due = isset($_POST['due']) ? $_POST['due'] : '';
$closed = isset($_POST['closed']) ? $_POST['closed'] : '';
$canceled = isset($_POST['canceled']) ? $_POST['canceled'] : '';
$tags = isset($_POST['tags']) ? implode(",",$_POST['tags']) : '';

$newligne = [$number,$name, $status,$old_status, $creation, $start, $due, $closed, $canceled, $tags];

$checked = true;
if (!empty($due) && $due< $start) {
    $checked = false;
    $msg= "Echéance antérieur au début de la tâche";
}

if ($checked) {
    addnewtask ($newligne);
    $msg = 'Ajout avec succes';
    header('Location: ../view/card.php?task='.$number.'&msg='.$msg);
} else {
    header('Location: ../form/addcardform.php?task='.$number.'&msg='.$msg);
}

function addnewtask ($task):bool {
    $fp = fopen('../tasks.csv', 'a');
    fputcsv($fp,$task );
    fclose($fp);
    return true;
}

