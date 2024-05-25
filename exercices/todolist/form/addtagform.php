<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
    <title>Ajouter une nouvelle tâche</title>
</head>
<body>
<?php
include('../function.php');
$alltags = readcsv('../tags.csv');
$nextnumber = lastnumber($alltags) + 1;
?>
<div class="addform">
    <form action="../action/addtag.php" method="post">
        <fieldset>
            <legend>Ajouter une nouvelle catégorie</legend>
            <input type="hidden" name="number"  placeholder="Numéro" value="<?php echo $nextnumber; ?>">
            <input type="text" name="name"  placeholder="Nom" value="" required>
            <input type="color" name="color"  placeholder="color" value="" required>
            <input type="submit" name="Confirmer"/>
        </fieldset>
    </form>
</div>
</body>
</html>
