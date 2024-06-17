<?php

/**
 * Fonction qui retourne la valeur la plus grande de la première colonne (emplacement de l'id) dans un tableau à deux dimension
 *
 * @param $arrays: Tableau à deux dimension qui contient une liste de tâche
 * @return int : valeur maximum du numéro d'identification de la tâche
 */
function nextnumber ($arrays) :int {
    $max=0;
    foreach ($arrays as $record){

        if ($record[0] > $max){
            $max=(int)$record[0];
        }
    }
    return $max+1;
}

/**
 * Fonction qui retourne une tâche dans une liste de tâche (tableau à deux dimensions)
 *
 * @param $array array: Tableau à deux dimension qui contient une liste de tâche
 * @param $number : Numéro de la tâche à chercher
 * @return false|mixed
 */
function findtask ($array, $number){
    foreach ($array as $tasks) {
        if ($tasks['number'] == $number) {
            return $tasks;
        }
    }
    return false;
}

/**
 * Fonction qui lit simplement le contenu d'un CSV et le renvoie dans un tableau
 *
 * @param $filename String: Chemin d'accès du fichier
 * @return array
 */
function readcsv ($filename) {
    $lignes = [];
    $fp = fopen($filename, 'r');
    while (($row = fgetcsv($fp)) !== false) {
        $lignes[] = $row;
    }
    fclose($fp);
    return $lignes;
}

/**
 * Fonction qui sur base d'une liste de tâche (tableau à deux dimension) créé un nouveau tableau fitré sur le
 * status de la tâche
 *
 * @param $arrayoftasks array: tableau qui contient toutes les tâches
 * @param $status string: Statut sur lequel on filtre
 * @return array
 */
function statusfilteredarray ($arrayoftasks, $status): array {
    $result=[];
    foreach ($arrayoftasks as $task) {
        if ($task['status'] == $status) {
            $result[] = $task;
        }
    }
    return $result;
}

/**
 * Fonction qui sur base d'un fichier CSV créé un tableau à deux dimension (liste de tableau associatif) dont les clefs
 * sont créés sur base de la première ligne qui contient les en-têtes de colonnes
 *
 * @param $filename String: Chemin d'accès du fichier
 * @return array
 */
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

/**
 * Fonction qui sur base d'un tableau à deux dimension (liste de tableau associatif) met à jour un fichier CSV existant
 *
 * @param $array array: Liste de tâches qui doit contenir un tableau associatif (clef->valeur)
 * @param $filename string: chemin d'accès au fichier à corriger
 * @return true
 *  */
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

/**
 * Fonction de tri basé sur le Bubble sort qui trie une liste de tâche sur base de son nom (ordre croissant)
 *
 * @param $a array: Tâche A
 * @param $b array: Tâche B
 * @return int|void
 */
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

/**Fonction de tri basé sur le Bubble sort qui trie une liste de tâche sur base de son nom (ordre décroissant)
 *
 * @param $a array: Tâche A
 * @param $b array: Tâche B
 * @return int|void
 */
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

/**
 * Fonction de tri basé sur le Bubble sort qui trie une liste de tâche sur base de son id (ordre croissant)
 *
 * @param $a array: Tâche A
 * @param $b array: Tâche B
 * @return int|void
 */
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

/** Fonction de tri basé sur le Bubble sort qui trie une liste de tâche sur base de son id (ordre décroissant)
 *
 * @param $a array: Tâche A
 * @param $b array: Tâche B
 * @return int|void
 */
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

/**
 * Fonction qui créé une nouvelle tâche dans un fichier CSV
 *
 * @param $task array: qui contient les données de la tâche
 * @return bool True si ajout réussi, False, si échoué
 */
function addnewtask ($task):bool {
    $fp = fopen('../model/tasks.csv', 'a');
    fputcsv($fp,$task );
    fclose($fp);
    return true;
}

/**
 * Fonction qui rajoute une nouvelle pièce-jointe dans une tâche
 *
 * @param $file String: Nom de fichier de la pièce-jointe à ajouter
 * @return bool: True si ajout réussi, False, si échoué
 */
function addnewfile (array $file):bool {
    $fp = fopen('../model/files.csv', 'a');
    fputcsv($fp,$file );
    fclose($fp);
    return true;
}

/**
 * Fonction qui rajoute un nouveau commentaire dans une tâche
 *
 * @param $comment array: Commentaire à ajouter
 * @return bool : True si ajout réussi, False, si échoué
 */
function addnewcomment(array $comment):bool {
    $fp = fopen('../model/comments.csv', 'a');

    fputcsv($fp,$comment );
    fclose($fp);
    return true;
}

/**
 * Fonction qui rajoute une nouvelle entrée dans une liste
 *
 * @param $entry array: Entrée à ajouter à la liste de cette tâche
 * @return bool : True si ajout réussi, False, si échoué
 */
function addnewentrylist(array $entry):bool {
    $fp = fopen('../model/minitasklist.csv', 'a');
    fputcsv($fp,$entry );
    fclose($fp);
    return true;
}

/**
 * Fonction qui ajoute une nouvelle catégorie d'étiquette pour une tâche
 *
 * @param $task array Nouvelle catégorie à rajouter
 * @return bool true si l'ajout à fonctionné
 */
function addnewtag (array $tag):bool {
    $fp = fopen('../model/tags.csv', 'a');
    fputcsv($fp,$tag );
    fclose($fp);
    return true;
}

/**
 * Fonction qui recherche dans un fichier csv qui contient les piéces jointes
 * @param $filename String: Chemin d'accès du fichier qui contient les pièces-jointes
 * @param $number int: Numéro de la tâche dont je dois récupérer la liste des pièces-jointes
 * @return array: Liste des pièces-jointes
 */
function findfilefromtasknumber ($filename, $number) {
    $lignes = [];
    $fp = fopen($filename, 'r');
    while (($row = fgetcsv($fp)) !== false) {
        if ($row[1] == $number) {
            $lignes[] = $row;
        }
    }
    fclose($fp);
    return $lignes;
}

/**
 * Fonction qui recherche dans le fichier CSV qui contient les pièces jointes, si celle-ci est déjà existantes dans
 * une autre tâche
 * @param $filename string: Chemin d'accès au fichier
 * @param $fichier String: Nom du fichier à rechercher
 * @return int|mixed : retourne le numéro de la tâche ou -1 si pas trouvé
 */
function findtasknumberfromfile ($filename, $fichier) {
    $fp = fopen($filename, 'r');
    while (($row = fgetcsv($fp)) !== false) {
        if ($row[1] == $fichier) {
            return $row[0];
        }
    }
    fclose($fp);
    return -1;
}

/**
 * Fonction qui récupère dans un fichier CSV qui contient les entrées d'une liste lié à une tâche
 * basé sur son numéro
 *
 * @param $filename String: Chemin d'accès du fichier qui contient les commentaires.
 * @param $number int : Numéro de la tâche concernée
 * @return array : Liste des entrées récupérés
 */
function findentrylistfromtasknumber ($filename, $number) {
    $lignes = [];
    $fp = fopen($filename, 'r');
    while (($row = fgetcsv($fp)) !== false) {
        if ($row[1] == $number) {
            $lignes[] = $row;
        }
    }
    fclose($fp);
    return $lignes;
}


/**
 * Fonction qui vérifie les dates reçues d'un formulaire avant de modifier le fichier qui contient les données sauvegarder.
 * Elle effectue quelques tests pour la cohérence des données.
 *
 * @param $start int: Date de début de la tâche
 * @param $due int: Echéance de la tâche
 * @param $closed int: Date de cloture de la tâche
 * @param $cancelled int: Date d'annulation de la tâche
 * @return array : Tableau d'erreurs. Chaque erreur est compilée dans un tableau
 */
function checksondate($start, $due, $closed, $cancelled): array
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
        // Une date de cloture avant la date de début a été encodées
        if (!empty($closed) && ($closed < $start)) {
            $checked = false;
            $msg = "Une tâche ne peut être terminée avant son commencement";
            $error[] = $checked;
            $error[] = $msg;
            $result[] = $error;
            unset($error);
        }
    } while (0);
    return $result;
}

/**
 * Sur base des dates encodées dans une tâche, cette fonction détermine pour la date du planning quel était le statut
 * de la tâche
 *
 * @param $date int : date dans le planning à tester
 * @param $start int : date de début de la tâche
 * @param $due int : échéance prévue pour réaliser la tâche
 * @param $closed int : date de cloture de la tâche
 * @param $cancelled int : date d'annulation de la tache
 * @return string : statut pour la date (il sera utilisé pour le CSS)
 *
 * si la date se situe entre le début et l'échéance : P
 * si elle se situe entre la date de début et la cloture: T
 * si elle se situe avant l'échéance mais après la cloture: B
 * si elle se situe après l'échéance mais après la cloture: M
 * si la tâche a été annullée en cours de réalisation:
 * L pour les jours entre la date de début et la date d'annulation
 * W pour les jours entre la date d'annulation et l'échéance
 */
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
                $status = "L";
            }
            if ($start <= $date && $date <= $due && $date <= $cancelled) {
                $status = "W";
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

/**
 * Fonction qui retourne une liste de commentaires sur base d'une liste de tous les commentaires et le numéro d'une tâche
 * @param $arrayofcomments array : Liste de tous les commentaires
 * @param $tasknumber string : Numéro de la tâche
 * @return array : Liste des commentaires de la tâche en question
 */
function tasknumberfilteredcomments ($arrayofcomments, $tasknumber): array {
    $result=[];
    foreach ($arrayofcomments as $comment) {
        if ($comment['tasknumber'] == $tasknumber) {
            $result[] = $comment;
        }
    }
    return $result;
}