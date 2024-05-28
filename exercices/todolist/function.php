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

function addnewcomment($file):bool {
    $fp = fopen('../comments.csv', 'a');
    fputcsv($fp,$file );
    fclose($fp);
    return true;
}

function findfilefromtasknumber ($filename, $number) {
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

function findtasknumberfromfile ($filename,$fichier) {
    $fp = fopen($filename, 'r');
    while (($row = fgetcsv($fp)) !== false) {
        if ($row[1] == $fichier) {
            return $row[0];
        }
    }
    fclose($fp);
    return -1;
}

function findcommentsfromtasknumber ($filename, $number) {
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

function checksondate($start, $due, $closed, $cancelled)
{
    $result = [];
    do {
        // La date d'échéance est antérieur à la date de début de la tâche
        if (!empty($due) && ($due < $start)) {
            $checked = false;
            $msg = "Echéance antérieur au début de la tâche";
            $error[] = $checked;
            $error[] = $msg;
            $result[] = $error;
            unset($error);
        }
        // Une date de fin et d'annulation ont été encodées
        if (!empty($closed) && !empty($cancelled)) {
            $checked = false;
            $msg = "Une tâche terminée ne peut pas être annulée";
            $error[] = $checked;
            $error[] = $msg;
            $result[] = $error;
            unset($error);
        }
    } while (0);

    return $result;
}

function checkdateforplanning($date,$start, $due, $closed, $cancelled)
{
    $status = "";
    if (!empty($start) && !empty($due)) {
        if (empty($cancelled)) {
            if ($start <= $date && $date <= $due) {
                $status = "P";
            }
        } else {
            if ($start <= $date && $date <= $due) {
                $status = "W";
            }
            if ($start <= $date && $date <= $due && $date <= $cancelled) {
                $status = "L";
            }
        }

    }
    if (!empty($start) && !empty($closed)) {
        if ($start <= $date && $date <= $closed) {
            $status = "T";
        }
    }
    if (!empty($start) && !empty($due) && !empty($closed)) {
        if ($date > $closed && $date <= $due) {
            $status = "B";
        }
        if ($date > $due && $date <= $closed) {
            $status = "M";
        }
    }

    return $status;
}
