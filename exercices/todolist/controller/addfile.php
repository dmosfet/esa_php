<?php ob_start();
include ('../function.php');
$number = $_POST['number'];

$destination ='../upload/'.$_FILES['nomFile']['name'];

echo file_exists($destination);
if (file_exists($destination)) {
    $tasknumber =findtasknumberfromfile('../model/files.csv',$_FILES['nomFile']['name']);
    $msg= urlencode("Ce fichier a déjà été uploadé dans la tâche #".$tasknumber);
} else {
    $newfile= [$number,$_FILES['nomFile']['name']];
    $msg= urlencode("Le fichier n'a pu être inséré");
    if (move_uploaded_file($_FILES['nomFile']['tmp_name'], $destination)) {
        $msg=urlencode("Nouveau fichier inséré");
        addnewfile($newfile);
    }
}
header('Location: ../index.php?mode=cardviewer&task='.$number.'&msg='.$msg);