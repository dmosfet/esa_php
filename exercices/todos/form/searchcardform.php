<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../CSS/pico/pico.min.css">
    <link rel="stylesheet" href="../CSS/style.css">
    <title>Ajouter une nouvelle tâche</title>
</head>
<body>
<?php
include('../function.php');
$allstaks = readcsv('../tasks.csv');
$number = lastnumber($allstaks);
$today = date("d-m-Y");

?>
<div class="addform">
    <form action="../action/addcard.php" method="post">
        <fieldset>
            <legend>Recherche une tâche sur base de son nom ou du numéro</legend>
            <label>Numéro</label>
            <input type="text" name="number" value="<?php echo $number + 1; ?>"/>
            <label>Nom de la tâche</label>
            <input type="text" name="name"/>
        </fieldset>
    </form>
</div>
</body>
</html>
