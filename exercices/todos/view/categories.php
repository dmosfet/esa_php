<!doctype html>
<html lang="fr" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
    <link rel="stylesheet" href="../CSS/style.php">
    <title>Tâche</title>
</head>
<body>
<?php
include("../function.php");
if (isset($_GET['msg'])) {
    $message = $_GET['msg'];
    ?>
    <dialog open>
        <form method="dialog">
            <div class="dialog">
                <label><?php echo $message ?></label>
                <button>OK</button>
            </div>
        </form>
    </dialog>
    <?php
}
$alltags = arrayfromcsv('../tags.csv');
$colortheme = arrayfromcsv('../colortheme.csv');

?>
<table>
    <caption>
        Liste des catégories
    </caption>
    <thead>
    <tr>
        <th scope="col">Numéro</th>
        <th scope="col">Nom</th>
        <th scope="col">Couleur</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <?php foreach ($alltags

        as $tag) {
        ?>
        <th><?php echo $tag['number']; ?></th>
        <td><?php echo $tag['name']; ?></td>
        <td style="background-color: <?php echo $tag['color'];?>"></td>
    </tr>
    <?php
    }
    ?>

    </tbody>

</table>
<a onclick="window.open('../form/addtagform.php','local', 'width=800 , height=900')"
   title="Ajouter une catégorie">
    <div class="addtag"></div>
</a>

<form method="post">
    <fieldset>
        <input type="submit" name="close" value="Fermer" onclick="refreshAndClose()">
    </fieldset>
</form>
<script type="text/javascript">
    function refreshAndClose() {
        window.opener.location.reload(true);
        window.close();
    }
</script>
</body>
</html>

