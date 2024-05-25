<?php
include ('../function.php');
$number = $_POST['number'];

$destination ='../upload/'.$_FILES['nomFile']['name'];

$msg= urlencode("Le fichier n'a pu être insérér");
 if (move_uploaded_file($_FILES['nomFile']['tmp_name'], $destination)) {
     $msg=urlencode("Nouveau fichier inséré");
 };

$newfile= [$number,$_FILES['nomFile']['name']];

addnewfile($newfile);

header('Location: ../view/card.php?task='.$number.'&msg='.$msg);