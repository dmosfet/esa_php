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
<?php
include("../function.php");

// On récupère les données du formulaire envoyées depuis ../form/modifycardform.php
$updatedtask = $_POST;
$number = $updatedtask['number'];

// On supprime l'input "submit" du formulaire reçu
unset($updatedtask['submit']);

// On recherche les données originales de la tâche à modifier
// On récupère toutes les tâches déjà encodées
$alltasks = arrayfromcsv("../tasks.csv");

foreach ($alltasks as $task) {
    if ($task['number'] == $updatedtask['number']) {
        $oldvaluetask = $task;
        break;
    }
}

// On recast les dates en int même si pas modifié
$updatedtask['creation'] = !(empty($updatedtask['creation'])) ? strtotime($updatedtask['creation']) : '';
$updatedtask['start'] = !(empty($updatedtask['start'])) ? strtotime($updatedtask['start']) : '';
$updatedtask['due'] = !(empty($updatedtask['due'])) ? strtotime($updatedtask['due']) : '';
$updatedtask['closed'] = !(empty($updatedtask['closed'])) ? strtotime($updatedtask['closed']) : '';
$updatedtask['cancelled'] = !(empty($updatedtask['cancelled'])) ? strtotime($updatedtask['cancelled']) : '';


// On transforme l'array tags reçues en un string séparé par une virgule'
if (!(empty($updatedtask['tags']))) {
    $updatedtask['tags'] = implode(",", $updatedtask['tags']);
} else {
    $updatedtask['tags'] = "";
}

// Vérification de cohérence des dates, on arrête les vérifications à la première incohérence

$start=$updatedtask['start'];
$due=$updatedtask['due'];
$closed=$updatedtask['closed'];
$cancelled=$updatedtask['cancelled'];

$errors = checksondate($start, $due, $closed, $cancelled);

// On réalise des vérifications avant de réécrire
//On initialise une variable $checked à true. On la change en false si on trouve une incohérence
if (!($errors)) {
    if ((empty($oldvaluetask['start']))  and !(empty($updatedtask['start']))) {
        $updatedtask['status'] = "1";
    }
    $alltasks[array_search($oldvaluetask, $alltasks)] = $updatedtask;
    csvfromarray($alltasks,'../tasks.csv');
    $msg = "Modification réalisée";
    $msg=urlencode($msg);
    header('Location: ../view/card.php?task=' . $number . '&msg=' . $msg);
} else {
    foreach ($errors as $error) {
        $errorlist[] = $error[1];
    }
    $msg = urlencode(implode(',', $errorlist));
    header('Location: ../form/modifycardform.php?task=' . $number . '&msg=' . $msg);
}
?>
</body>
</html>

