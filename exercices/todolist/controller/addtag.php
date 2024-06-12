<?php
include('../function.php');
$number = $_POST['number'] ?? '1';
$name = $_POST['name'] ?? '';
$color = $_POST['color'] ?? '';

$newligne = [$number,$name, $color];

addnewtag ($newligne);
$msg = 'Ajout de la catégorie avec succes';
$msg = urlencode($msg);

header('Location: ../index.php?mode=settings&msg='.$msg);
