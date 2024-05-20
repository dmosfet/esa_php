<?php

$name = isset($_POST['name']) ? $_POST['name'] : '';
$number = isset($_POST['number']) ? $_POST['number'] : '';


$newligne = [$number, $name, 0];

$fp = fopen('tasks.csv', 'a');
fputcsv($fp, $newligne);
fclose($fp);

$msg = "Ajout OK";
header('Location: index.php?msg=' . $msg);