<?php ob_start();
include ('../function.php');
$number = $_POST['number'];

$destination ='../upload/'.$_FILES['nomFile']['name'];

if (file_exists($destination)) {
    $tasknumber =findtasknumberfromfile('../files.csv',$_FILES['nomFile']['name']);
    $msg= urlencode("Ce fichier a déjà été uploadé dans la tâche #".$tasknumber);
} else {
    $newfile= [$number,$_FILES['nomFile']['name']];
    $msg= urlencode("Le fichier n'a pu être insérér");
    if (move_uploaded_file($_FILES['nomFile']['tmp_name'], $destination)) {
        $msg=urlencode("Nouveau fichier inséré");
        addnewfile($newfile);
    }
}

header('Location: ../view/card.php?task='.$number.'&msg='.$msg);