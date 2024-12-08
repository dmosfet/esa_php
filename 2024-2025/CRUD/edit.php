<?php

$id = isset($_GET["id"]) ? $_GET["id"] : 0;

require_once "Db.php";
$db = new Db();
$user = $db->findOne($id);

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css" >
</head>
<body>

<main class="container">
    <form method="POST" action="update.php">
        <fieldset>Editer un enregistrement
            <label for="nom">Nom</label>
            <input type="hidden" name="id" value="<?=$user->id?>"></br>
            <input type="text" name="nom" value="<?=$user->nom?>"></br>
            <label for="nom">Prénom</label>
            <input type="text" name="prenom" value="<?=$user->prenom?>"></br>
            <label for="nom">Email</label>
            <input type="email" name="email" value="<?=$user->email?>"></br>
            <input type="submit" value="Ajouter">
        </fieldset>
    </form>
</main>
</body>
</html>
