<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../CSS/pico/pico.min.css">
    <title>Ajouter une nouvelle tâche</title>
</head>
<body>
<?php
include('../function.php');
$allstaks = readcsv('../tasks.csv');
$nextnumber = lastnumber($allstaks) + 1;
$today = date("d-m-Y");


$number = $nextnumber;
$name = "";
$status = isset($_GET["status"]) ? $_GET["status"] : "0";
$old_status = "0";
$creation= $today;
$start = "";
$due = "";
$closed = "";
$cancelled = "";
$tags = "";

?>
<div class="addform">
    <form action="../action/addcard.php" method="post">
        <fieldset>
            <legend>Ajouter une nouvelle tâche</legend>
            <?php include('../model/form_model.php'); ?>
            <input type="submit" name="Confirmer"/>
        </fieldset>
    </form>
</div>
</body>
</html>
