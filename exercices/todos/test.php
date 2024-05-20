<?php
$test= arrayfromcsv('tasks.csv');

function arrayfromcsv ($filename): array {
    $datas=[];
    $record=[];
    $fp = fopen($filename, 'r');
    $columns = fgetcsv($fp);
    var_dump($columns);
    $numbercolumns = count($columns)-1;
    while (($row = fgetcsv($fp)) !== false) {
        $datas[] = $row;
    }
    foreach ($datas as $ligne) {
        for ($i=0; $i<=$numbercolumns; $i++) {
            $record[$columns[$i]] = $ligne[$i];
        }
        $result[] = $record;
    }
    fclose($fp);
    return $result;
}