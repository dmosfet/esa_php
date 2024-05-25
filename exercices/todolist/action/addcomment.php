<?php ob_start();
include ('../function.php');
$number = $_POST['number'];
$comment = isset($_POST['comment']) ? $_POST['comment'] : 'Aucun commentaires';

$newligne = [$number,$comment];

$msg=urlencode("Ce commentaire n'a pu être ajouté");

if (addnewcomment ($newligne));
{
    $msg = 'Ajout avec succès';
    $msg = urlencode($msg);
}
header('Location: ../view/card.php?task='.$number.'&msg='.$msg);