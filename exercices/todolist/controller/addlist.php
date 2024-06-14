<?php ob_start();
include ('../function.php');

$id = $_POST['id'];
$number = $_POST['number'];
$entry = isset($_POST['entry']) ? $_POST['entry'] : '';

$newligne = [$id, $number,$entry,$status=0];

$msg=urlencode("Cette entrée n'a pu être ajouté");


if (addnewentrylist($newligne))
{
    $msg = 'Ajout avec succès';
    $msg = urlencode($msg);
}

header('Location: ../index.php?mode=cardviewer&task='.$number.'&msg='.$msg);
