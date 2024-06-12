<?php
echo "coucou";
require($_SERVER['DOCUMENT_ROOT'].'function.php');
$allstaks = readcsv($_SERVER['DOCUMENT_ROOT'].'/model/tasks.csv');

var_dump($allstaks);