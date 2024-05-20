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
$number = lastnumber($allstaks);
$today = date("d-m-Y");
$status = isset($_GET["status"]) ? $_GET["status"] : "0";

?>
<div class="addform">
    <form action="../action/addcard.php" method="post">
        <fieldset>
            <legend>Ajouter une nouvelle tâche</legend>
            <input type="hidden" name="number" value="<?php echo $number + 1; ?>"/>
            <label>Nom de la tâche</label>
            <input type="text" name="name"/>
            <input type="hidden" name="status" value="<?php echo $status; ?>"/>
            <input type="hidden" name="old_status" value="<?php echo $status; ?>"/>
            <label>Date de création</label>
            <input type="text" name="creation" value="<?php echo $today; ?>"/>
            <label>Date de début</label>
            <input type="text" name="start" value="Non démarré"/>
            <label>Echeance</label>
            <input type="text" name="due" value=""/>
            <label>Date de clôture</label>
            <input type="text" name="closed" value=""/>
            <label>Date d'abandon</label>
            <input type="text" name="giveup" value=""/>
            <label>Tags</label>
            <input type="text" name="tags" value=""/>
            <input type="submit" name="soumettre"/>
        </fieldset>
    </form>
</div>
</body>
</html>
