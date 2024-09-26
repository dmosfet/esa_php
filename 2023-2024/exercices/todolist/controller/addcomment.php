<?php ob_start();
include('../function.php');
$id = $_POST['id'];
$tasknumber = $_POST['tasknumber'];
$comment = isset($_POST['comment']) ? $_POST['comment'] : 'Aucun commentaires';
$date = date("d-m-Y - H:i:s");
$user = $_POST['iduser'];

$newligne = [$id, $tasknumber,$comment,$date];

$msg=urlencode("Ce commentaire n'a pu être ajouté");

if (addnewcomment ($newligne)) {
    $msg = 'Ajout avec succès';
    $msg = urlencode($msg);

    // On notifie si un utilisateur est renseigné
    if ($user != null) {
        $allnotifications = readcsv('../model/notification.csv');
        $nextidnotification = nextnumber($allnotifications);

        $newnotification = [$nextidnotification, time(), "Un nouveau commentaire a été ajouté", $tasknumber, $user, "0"];
        addnewnotification($newnotification);
    }
}
header('Location: ../index.php?mode=cardviewer&task='.$tasknumber.'&msg='.$msg);