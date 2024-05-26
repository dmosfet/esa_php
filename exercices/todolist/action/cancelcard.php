<?php ob_start()?>
<!doctype html>
<html lang="fr" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tâche</title>
</head>
<body>
<?php include("../function.php");
$number = $_GET['task'];
$allstasks = arrayfromcsv("../tasks.csv");

// retourne les valeurs complètes de la tâches qu'on démarre.
$tasktocancel=findtask($allstasks, $number);

// retourne la position de la tâche dans la liste
$position = array_search($tasktocancel, $allstasks);

// update la valeur orginal puis update la liste via son index
$tasktocancel['status'] = 3;
$tasktocancel['cancelled'] = time();
$allstasks[$position] = $tasktocancel;

// réécrit le fichier csv
$msg = "La tâche n'as pas pu être annulée";
if (csvfromarray($allstasks,'../tasks.csv')) {
    $msg = "La tâche a été annulée";
}
$msg = urlencode($msg);
header('Location: ../view/card.php?task='.$number.'&msg='.$msg);
?>
</body>
</html>

