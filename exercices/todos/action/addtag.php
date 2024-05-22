<?php

$number = isset($_POST['number']) ? $_POST['number'] : '1';
$name = isset($_POST['name']) ? $_POST['name'] : '';
$color = isset($_POST['color']) ? $_POST['color'] : '';

$newligne = [$number,$name, $color];


addnewtag ($newligne);
$msg = 'Ajout de la catégorie avec succes';
header('Location: ../view/settings.php?msg='.$msg);

function addnewtag ($task):bool {
    $fp = fopen('../tags.csv', 'a');
    fputcsv($fp,$task );
    fclose($fp);
    return true;
}

