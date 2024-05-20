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

copytasktodeletedtask($tasktocancel);

// supprime la tâche de la liste basée sur son index
unset($allstasks[$position]);

// réécrit le fichier csv
$msg = "Task not deleted";
if (csvfromarray($allstasks,'../tasks.csv')) {
    $msg = "Task deleted successfully";
}

header('Location: ../view/recycle.php?msg='.$msg);

function copytasktodeletedtask ($task):bool {
    $fp = fopen('../deletedtasks.csv', 'a');
    fputcsv($fp,$task );
    fclose($fp);
    return true;
}
?>

</body>
</html>