<?php ob_start();
include ('../function.php');
$id = $_POST['id'];
$tasknumber = $_POST['tasknumber'];
$comment = isset($_POST['comment']) ? $_POST['comment'] : 'Aucun commentaires';
$date = date("d-m-Y - H:i:s");

$newligne = [$id, $tasknumber,$comment,$date];

$msg=urlencode("Ce commentaire n'a pu être ajouté");

if (addnewcomment ($newligne)) {
    $msg = 'Ajout avec succès';
    $msg = urlencode($msg);
}
header('Location: ../index.php?mode=cardviewer&task='.$tasknumber.'&msg='.$msg);