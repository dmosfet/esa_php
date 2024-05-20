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

function afficheclosedtasks ($filename) {
    $closedtasks = [];
    $fp = fopen($filename, 'r');
    while (($row = fgetcsv($fp)) !== false) {
        if ($row[2]==2) {
            $closedtasks[] = $row;
        }
    }
    fclose($fp);
    return $closedtasks;
}

function afficheopenedtasks ($filename) {
    $closedtasks = [];
    $fp = fopen($filename, 'r');
    while (($row = fgetcsv($fp)) !== false) {
        if ($row[2]==1) {
            $closedtasks[] = $row;
        }
    }
    fclose($fp);
    return $closedtasks;
}

function affichenewtasks ($filename) {
    $newtasks = [];
    $fp = fopen($filename, 'r');
    while (($row = fgetcsv($fp)) !== false) {
        if ($row[2]==0) {
            $newtasks[] = $row;
        }
    }
    fclose($fp);
    return $newtasks;
}

function affichedroppedtasks ($filename) {
    $closedtasks = [];
    $fp = fopen($filename, 'r');
    while (($row = fgetcsv($fp)) !== false) {
        if ($row[2]==3) {
            $closedtasks[] = $row;
        }
    }
    fclose($fp);
    return $closedtasks;
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


