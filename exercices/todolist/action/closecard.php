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
$tasktoclose=findtask($allstasks, $number);

// retourne la position de la tâche dans la liste
$position = array_search($tasktoclose, $allstasks);

// update la valeur orginal puis update la liste via son index
$tasktoclose['old_status'] = $tasktoclose['status'];
$tasktoclose['status'] = 2;
$tasktoclose['closed'] = time();
$allstasks[$position] = $tasktoclose;

$checked = true;

if (empty($tasktoclose['start'])) {
    $msg = "La tâche n'a pas débutée";
    $checked = false;
}

// réécrit le fichier csv

if ($checked) {
    if (csvfromarray($allstasks,'../tasks.csv')) {
        $msg = "La tâche a été clôturée";
    }
}
$msg = urlencode($msg);
header('Location: ../view/card.php?task='.$number.'&msg='.$msg);
?>
</body>
</html>