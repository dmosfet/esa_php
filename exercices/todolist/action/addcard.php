<?php
include ('../function.php');
$number = isset($_POST['number']) ? $_POST['number'] : '1';
$name = isset($_POST['name']) ? $_POST['name'] : '';
$description = isset($_POST['description']) ? $_POST['description'] : '';
$status = isset($_POST['status']) ? $_POST['status'] : '0';
$old_status = isset($_POST['old_status']) ? $_POST['old_status'] : '0';
$creation = !(empty($_POST['creation'])) ? stringdatereverse($_POST['creation']) : $today = date("d-m-Y");
$start = !(empty($_POST['start'])) ? stringdatereverse($_POST['start']) : '';
$due = (isset($_POST['due']) && !(empty($_POST['due'])))? stringdatereverse($_POST['due']) : '';
$closed = (isset($_POST['closed'])  && !(empty($_POST['due']))) ? stringdatereverse($_POST['closed']) : '';
$cancelled = (isset($_POST['cancelled']) && !(empty($_POST['due']))) ? stringdatereverse($_POST['cancelled']) : '';
$tags = isset($_POST['tags']) ? implode(",",$_POST['tags']) : '';

$newligne = [$number,$name, $description, $status, $old_status, $creation, $start, $due, $closed, $cancelled, $tags];

$checked = true;
if (!empty($due) && $due< $start) {
    $checked = false;
    $msg= "Echéance antérieur au début de la tâche";
}

if ($checked) {
    addnewtask ($newligne);
    $msg = 'Ajout avec succès';
    $msg = urlencode($msg);
    header('Location: ../view/card.php?task='.$number.'&msg='.$msg);
} else {
    $msg = urlencode($msg);
    header('Location: ../form/addcardform.php?task='.$number.'&msg='.$msg);
}



