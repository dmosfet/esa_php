<!doctype html>
<html lang="fr" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../CSS/pico/pico.min.css">
    <link rel="stylesheet" href="../CSS/style.css">
    <title>Tâche à modifier</title>
</head>
<body>
<?php include("../function.php");
$number = isset($_POST['number']) ? $_POST['number'] : $_GET['task'];
$array = arrayfromcsv("../tasks.csv");
$task = findtask($array, $number);
?>
<form action="../action/modifycard.php" method="post">
    <fieldset>
        <legend><?php echo '#' . $number . " -" . $task['name']; ?></legend>
        <?php
        foreach ($task as $clef => $valeur) {
            $label = match($clef) {
                'number' => 'Numéro',
                'name' => 'Nom',
                'status' => 'Statut actuel',
                'old_status' => 'Ancien statut',
                'creation' => 'Date de creation',
                'start' => 'Date de début',
                'due' => 'Echéance',
                'closed' => 'Date de cloture',
                'canceled' => 'Date d\'annulation',
                'tags' => 'Catégories',
            };
            if (($clef == "number") || ($clef == "status") || ($clef == "old_status")) {
                ?>
                <input type="hidden"

                <?php } else { ?>
                <input type="text"
            <?php } ?>
            name="<?php echo $clef;?>" placeholder ="<?php echo $label; ?>" value ="<?php echo $valeur;?>">
        <?php
        }
        ?>
        <input type="submit" name="submit" value="Valider">
    </fieldset>
</form>
</body>
</html>

