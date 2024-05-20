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
$action = $_GET['action'];
$updatedtask = $_POST;
unset($updatedtask['submit']);
$allstasks = arrayfromcsv("../tasks.csv");

// retourne les valeurs originales
foreach ($allstasks as $task) {
    if ($task['number'] == $updatedtask['number']) {
        $searchedtask = $task;
        break;
    }
}

// update la valeur orginal par celle du formulaire via son index
$allstasks[array_search($searchedtask, $allstasks)] = $updatedtask;

csvfromarray($allstasks,'../tasks.csv');

header('Location: ../view/card.php?task='.$updatedtask['number']);
?>

</form>
</body>
</html>

