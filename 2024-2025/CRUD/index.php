<?php

require_once "Db.php";
$db = new Db();
$users = $db->findAll();

if (isset($_GET['msg'])) {
    $message = $_GET['msg'];
    ?>
    <dialog open>
        <form method="dialog">
            <div class="dialog">
                <label><?php echo urldecode($message) ?></label>
                <button>OK</button>
            </div>
        </form>
    </dialog>
    <?php
} ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
</head>
<body>

<main class="container">
    <h2>Esa CRUD</h2>
    <a href="create.php" role="button" class="outline">Ajouter</a>
    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Prenom</th>
            <th>Email</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $num = 1;
        ?>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= $num ?></td>
                <td><?= $user->nom ?></td>
                <td><?= $user->prenom ?></td>
                <td><?= $user->email ?></td>
                <td><a href="edit.php?id=<?= $user->id ?>" type="button" class="outline">Editer</a></td>
                <td><a href="delete.php?id=<?= $user->id ?>" type="button" class="outline">Supprimer</a></td>
            </tr>
        <?php
        $num++;
        endforeach; ?>
        </tbody>
    </table>
    <a href="create.php" type="button" class="outline">Ajouter</a>

</main>

</body>
</html>
