<?php
include('../function.php');
$id = $_SESSION['id'] ?? $_POST['id'];

$destination = '../images/profile/' . $_FILES['nomFile']['name'];

$newprofile = [$id, $_FILES['nomFile']['name']];
$msg = urlencode("Le fichier n'a pu être inséré");
if (move_uploaded_file($_FILES['nomFile']['tmp_name'], $destination)) {
    $msg = urlencode("Nouveau fichier inséré");
    addnewprofile($newprofile);
}
header('Location: ../index.php?mode=user&msg=' . $msg);
