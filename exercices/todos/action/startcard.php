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
$tasktostart=findtask($allstasks, $number);

// retourne la position de la tâche dans la liste
$position = array_search($tasktostart, $allstasks);

// update la valeur orginal puis update la liste via son index
$tasktostart['old_status'] = $tasktostart['status'];
$tasktostart['status'] = 1;
$tasktostart['start'] = date("d-m-Y");
$allstasks[$position] = $tasktostart;

// réécrit le fichier csv
$msg = "Task not started";
if (csvfromarray($allstasks,'../tasks.csv')) {
    $msg = "Task started";
}

header('Location: ../view/card.php?task='.$number.'&msg='.$msg);

?>

</form>
</body>
</html>

