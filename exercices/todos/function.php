<?php

function lastnumber ($arrays) :int {
    $max=0;
    foreach ($arrays as $record){

        if ($record[0] > $max){
            $max=(int)$record[0];
        }
    }
    return $max;
}
function findtask ($array, $number){
    foreach ($array as $tasks) {
        if ($tasks['number'] == $number) {
            return $tasks;
        }
    }
    return false;
}
function readcsv ($filename) {
    $lignes = [];
    $fp = fopen($filename, 'r');
    while (($row = fgetcsv($fp)) !== false) {
        $lignes[] = $row;
    }
    fclose($fp);
    return $lignes;
}


function filtertaskonstatus ($filename, $status) {
    $result = [];
    $fp = fopen($filename, 'r');
    while (($row = fgetcsv($fp)) !== false) {
        if ($row[2]==$status) {
            $result[] = $row;
        }
    }
    fclose($fp);
    return $result;
}


function arrayfromcsv ($filename): array {
    $datas=[];
    $record=[];
    $fp = fopen($filename, 'r');
    $columns = fgetcsv($fp);
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

function csvfromarray ($array, $filename) {
    $fp = fopen($filename, 'r');
    $columns = fgetcsv($fp);
    fclose($fp);

    $fp = fopen($filename, 'w');
    fputcsv($fp, $columns);
    foreach ($array as $ligne) {
        fputcsv($fp, $ligne);
    }
    fclose($fp);
    return true;
}


