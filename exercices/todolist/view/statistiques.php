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
$alltasks = arrayfromcsv('../tasks.csv');
$newtasks = statusfilteredarray($alltasks, "0");
$startedtasks = statusfilteredarray($alltasks, "1");
$closedtasks = statusfilteredarray($alltasks, "2");
$cancelledtasks = statusfilteredarray($alltasks, "3");

$nbrnewtasks = count($newtasks);
$nbrstartedtasks = count($startedtasks);
$nbrclosedtasks = count($closedtasks);
$nbrcancelledtasks = count($cancelledtasks);
$nbrtasks = count($alltasks);

$delais=[];
$maxdelai=0;
$delaimoyen=0;
$total = 0;

foreach ($closedtasks as $task) {
    $delai = ($task['closed'] - $task['start']);
    $total += $task['closed']-$task['start'];
    $delais[] = $delai;
}

if ($nbrclosedtasks > 0) {
    $maxdelai = max($delais) / 60 /60 /24;;
    $delaimoyen = $total / $nbrclosedtasks / 60 /60 /24;
}

?>
<table>
    <caption>
        Statistiques des tâches par type
    </caption>
    <thead>
    <tr>
        <th scope="col">Tâches</th>
        <th scope="col">Total</th>
        <th scope="col">%</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>Nouvelles</td>
        <td><?php echo $nbrnewtasks;?></td>
        <td><?php echo $nbrnewtasks/$nbrtasks*100 . " %";?></td>
    </tr>
    <tr>
        <td>En cours</td>
        <td><?php echo $nbrstartedtasks;?></td>
        <td><?php echo $nbrstartedtasks/$nbrtasks*100 . " %";?></td>
    </tr>
    <tr>
        <td>Terminée</td>
        <td><?php echo $nbrclosedtasks;?></td>
        <td><?php echo $nbrclosedtasks/$nbrtasks*100 . " %";?></td>
    </tr>
    <tr>
        <td>Abandonnée</td>
        <td><?php echo $nbrcancelledtasks;?></td>
        <td><?php echo $nbrcancelledtasks/$nbrtasks*100 . " %";?></td>
    </tr>
    <tr>
        <td>Total</td>
        <td><?php echo $nbrtasks;?></td>
        <td><?php echo $nbrtasks/$nbrtasks*100 . " %";?></td>
    </tr>

    </tbody>
</table>

<table>
    <caption>
        Autres statistiques
    </caption>
    <thead>
    <tr>
        <th scope="col">Nom</th>
        <th scope="col">Valeur</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>Délai moyen de cloture</td>
        <td><?php echo $delaimoyen;?></td>
    </tr>
    <tr>
        <td>Delai max de cloture</td>
        <td><?php echo $maxdelai;?></td>
    </tr>
    </tbody>
</table>

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

