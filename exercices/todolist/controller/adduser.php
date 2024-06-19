<?php
include('../function.php');
$id = isset($_POST['id']) ? $_POST['id'] : '';
$firstname = isset($_POST['firstname']) ? $_POST['firstname'] : '';
$lastname = isset($_POST['lastname']) ? $_POST['lastname'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$password = isset($_POST['password']) ? md5($_POST['password']) : '';
$creation = $today = time();
$team = "default";
$pseudo= "";

// On vérifie si une utilisateur utilise déjà cette adresse mail

$allusers = arrayfromcsv('../model/users.csv');

$exist = false;

foreach ($allusers as $user) {
    if ($user['email'] == $email) {
        $exist = true;
        break;
    }
}
if ($exist) {
        $msg = "Un utilisateur utilise déjà cette adresse e-mail";
        echo "sur";
        header('Location: ../index.php?mode=adduserd&msg=' . urlencode($msg));
    } else {
        $newligne = [$id, $email,$password, $lastname, $firstname, $pseudo, $creation, $team ];
        addnewuser ($newligne);
        $msg = "Compte créé";
        header('Location: ../index.php?mode=adduserd&msg=' . urlencode($msg));

}