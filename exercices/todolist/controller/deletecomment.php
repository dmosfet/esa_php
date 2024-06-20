<?php ob_start();
include("../function.php");

$id = $_GET['id'];
$allcomments = arrayfromcsv('../model/comments.csv');

foreach ($allcomments as $comment) {
    if ($comment['id'] == $id) {
        $commenttodelete = $comment;
        $number = $comment['tasknumber'];
        break;
    }
}

// retourne la position de la tâche dans la liste
$position = array_search($commenttodelete, $allcomments);
// On garde le nom du fichier pour la suppression
unset($allcomments[$position]);

// réécrit le fichier csv
$msg = "Le commentaire n'a pu être supprimé";

if (csvfromarray($allcomments, '../model/comments.csv')) {
    $msg = "Le commentaire a été supprimé";
}

$msg = urlencode($msg);
header('Location: ../view/card.php?task=' . $number . '&msg=' . $msg);