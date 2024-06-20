<?php
session_start();

// On récupère les données du formulaire
$mail = $_POST['mail'];
$password = md5($_POST['password']);

// On récupères les données du fichier
$fp = fopen('../model/users.csv', 'r');
while (($row = fgetcsv($fp)) !== false) {
    $lignes[] = $row;
}
fclose($fp);

// On vérifie si les données du formulaire existent dans le fichier
$msg = "Erreur d'identifiant ou de mot de passe";
foreach ($lignes as $line) {
    if ($line[1] == $mail && $line[2] == $password) {
        $_SESSION['user'] = $line[3] . " " . $line[4];
        $_SESSION['id'] = $line[0];
        $msg = "Authentification réussie";
    }
}

// On retourne sur la page d'accueil avce le message adéquat
$msg = urlencode($msg);
header("location: ../index.php?msg=$msg");