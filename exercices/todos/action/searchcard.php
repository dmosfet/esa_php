<?php ob_start()?>
<!doctype html>
<html lang="fr" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../CSS/pico/pico.min.css">
    <link rel="stylesheet" href="../CSS/style.css">
    <title>Tâche</title>
</head>
<body>
<?php

include('../function.php');
$name = strtolower(isset($_POST['name']) ? $_POST['name'] : '');
$alltasks = arrayfromcsv('../tasks.csv');
$idfindedtask = "";

foreach ($alltasks as $task) {
    if (str_contains(strtolower($task['name']), $name)) {
        $idfindedtask .= $task['number'] . ";";
    }
}

header('Location: ../view/search.php?tasks='.$idfindedtask);

?>
</body>
</html>

