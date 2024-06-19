<?php
session_start();
$mail=$_POST['mail'];
$password=md5($_POST['password']);


$fp = fopen('../model/users.csv', 'r');
while (($row = fgetcsv($fp)) !== false) {
    $lignes[] = $row;
}
fclose($fp);

foreach($lignes as $line){
    if ($line[1] == $mail && $line[2] == $password){
        $_SESSION['user']=$line[3]." ". $line[4];
        $_SESSION['id']=$line[0];
    }
}

header ("location: ../index.php");