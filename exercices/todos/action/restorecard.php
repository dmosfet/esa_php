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
$tasktorestore=findtask($allstasks, $number);

// retourne la position de la tâche dans la liste
$position = array_search($tasktorestore, $allstasks);

// update la valeur orginal puis update la liste via son index
$tasktorestore['status'] = $tasktorestore['old_status'];
$tasktorestore['start'] = "";
$tasktorestore['due'] = "";
$tasktorestore['canceled'] = "";
$tasktorestore['closed'] = "";
$allstasks[$position] = $tasktorestore;

// réécrit le fichier csv
$msg = "La tâche n'a pu être restaurée";
if (csvfromarray($allstasks,'../tasks.csv')) {
    $msg = "La tâche a été restaurée";
}

$msg = urlencode($msg);
header('Location: ../view/card.php?task='.$number.'&msg='.$msg);
?>

</form>
</body>
</html>

