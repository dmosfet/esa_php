<?php

function stringdatereverse ($date) {
    $annee = substr($date, 0, 4);
    $mois = substr($date, 5, 2);
    $jour = substr($date, 8, 2);
    return $jour."-".$mois."-".$annee;
}
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

function statusfilteredarray ($arrayoftasks, $status): array {
    $result=[];
    foreach ($arrayoftasks as $task) {
        if ($task['status'] == $status) {
            $result[] = $task;
        }
    }
    return $result;
}
function arrayfromcsv ($filename): array {
    $datas=[];
    $record=[];
    $result=[];
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

function taskname_ascsort($a, $b)
{
    if (strtolower($a['name']) < strtolower($b['name'])) {
        return -1;
    }
    if (strtolower($a['name']) > strtolower($b['name'])) {
        return 1;
    }
    if (strtolower($a['name']) == strtolower($b['name'])) {
        return 0;
    }
}

function taskname_descsort($a, $b)
{
    if (strtolower($a['name']) > strtolower($b['name'])) {
        return -1;
    }
    if (strtolower($a['name']) < strtolower($b['name'])) {
        return 1;
    }
    if (strtolower($a['name']) == strtolower($b['name'])) {
        return 0;
    }
}
function taskid_ascsort($a, $b)
{
    if ($a['number'] < $b['number']) {
        return -1;
    }
    if ($a['number'] > $b['number']) {
        return 1;
    }
    if ($a['number'] == $b['number']) {
        return 0;
    }
}

function taskid_descsort($a, $b)
{
    if ($a['number'] > $b['number']) {
        return -1;
    }
    if ($a['number'] < $b['number']) {
        return 1;
    }
    if ($a['number'] == $b['number']) {
        return 0;
    }
}

function addnewtask ($task):bool {
    $fp = fopen('../tasks.csv', 'a');
    fputcsv($fp,$task );
    fclose($fp);
    return true;
}

function addnewfile ($file):bool {
    $fp = fopen('../files.csv', 'a');
    fputcsv($fp,$file );
    fclose($fp);
    return true;
}

function findcardfiles ($filename, $number) {
    $lignes = [];
    $fp = fopen($filename, 'r');
    while (($row = fgetcsv($fp)) !== false) {
        if ($row[0] == $number) {
            $lignes[] = $row;
        }
    }
    fclose($fp);
    return $lignes;
}