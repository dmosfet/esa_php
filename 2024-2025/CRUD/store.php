<?php

require_once 'Db.php';

echo '<pre>';
var_dump($_POST);
echo '</pre>';

if ((!empty($_POST['nom'])) || (!empty($_POST['prenom'])) || (!empty($_POST['email']))) {
    $db = new Db();
    $db->store($_POST);

    header('Location: index.php');
    exit;
}
header('Location: create.php');



