<?php ob_start();
include("../function.php");

// On récupère les données du formulaire

$new = $_POST['new'];
$started = $_POST['started'];
$closed = $_POST['closed'];
$cancelled = $_POST['cancelled'];

$new = match ($new) {
    'Par numéro, ordre croissant' => "taskid_ascsort",
    'Par numéro, ordre décroissant' => "taskid_descsort",
    'Par nom, ordre croissant' => "taskname_ascsort",
    'Par nom, ordre décroissant' => 'taskname_descsort',
};

$started = match ($started) {
    'Par numéro, ordre croissant' => "taskid_ascsort",
    'Par numéro, ordre décroissant' => "taskid_descsort",
    'Par nom, ordre croissant' => "taskname_ascsort",
    'Par nom, ordre décroissant' => 'taskname_descsort',
};

$closed = match ($closed) {
    'Par numéro, ordre croissant' => "taskid_ascsort",
    'Par numéro, ordre décroissant' => "taskid_descsort",
    'Par nom, ordre croissant' => "taskname_ascsort",
    'Par nom, ordre décroissant' => 'taskname_descsort',
};
$cancelled = match ($cancelled) {
    'Par numéro, ordre croissant' => "taskid_ascsort",
    'Par numéro, ordre décroissant' => "taskid_descsort",
    'Par nom, ordre croissant' => "taskname_ascsort",
    'Par nom, ordre décroissant' => 'taskname_descsort',
};

setcookie('new', $new, time() + (86400 * 30), "/");
setcookie('started', $started, time() + (86400 * 30), "/");
setcookie('closed', $closed, time() + (86400 * 30), "/");
setcookie('cancelled', $cancelled, time() + (86400 * 30), "/");

header('Location: ../index.php?mode=settings');