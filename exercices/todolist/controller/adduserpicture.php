<?php
session_start();
include('../function.php');

// On récupère l'ID de l'utilisateur connecté ainsi que les données du formulaire pour créer une nouvelle ligne
// à insérer dans le fichier users.csv

$id = $_SESSION['id'] ?? $_POST['id'];
$newprofile = [$id, $_FILES['nomFile']['name']];

// On précise le lieu de stockage de l'image
$destination = '../images/profile/' . $_FILES['nomFile']['name'];

// On vérifie si l'utilisateur dispose déja d'une photo de profil personnalisée
$allpictures = arrayfromcsv('../model/profilepicture.csv');
$pictureexist = false;

if (!empty($allpictures)) {
    foreach ($allpictures as $picture) {
        if ($picture['id'] == $id) {
            $pictureexist = true;
            $picturetomodify = $picture;
            break;
        }
    }
}

// S'il n'existe pas on rajouter simplement la ligne dans le fichier, sinon on actualise la ligne et réécrit le fichier
if (!$pictureexist) {
    $msg = urlencode("Le fichier n'a pu être inséré");
    if (move_uploaded_file($_FILES['nomFile']['tmp_name'], $destination)) {
        if (addnewprofile($newprofile)) {
            $msg = urlencode("Nouveau fichier inséré");
        }
    }
} else {
    // retourne la position de la tâche dans la liste
    $position = array_search($picturetomodify, $allpictures);
    unset($allpictures[$position]);
    $allpictures[] = $newprofile;
    if (move_uploaded_file($_FILES['nomFile']['tmp_name'], $destination)) {
        if (csvfromarray($allpictures, '../model/profilepicture.csv')) {
            $msg = urlencode("Nouveau fichier inséré");
        }
    }
}

// On retourne sur son profil en indiquant le message adéquat
header('Location: ../index.php?mode=user&msg=' . $msg);
