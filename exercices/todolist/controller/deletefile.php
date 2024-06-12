<?php ob_start()?>
<?php include("../function.php");

$number = $_GET['task'];
$file = urldecode($_GET['file']);

$allfiles = arrayfromcsv('../model/files.csv');

foreach ($allfiles as $file) {
    if ($file['number'] == $number && $file['namefile'] == $file) {
        $filetodelete = $file;
        break;
    }
}
// retourne la position de la tâche dans la liste
$position = array_search($filetodelete, $allfiles);
// On garde le nom du fichier pour la suppression
unset($allfiles[$position]);

// réécrit le fichier csv
$msg = "La pièce-jointe n'a pu être supprimée";

if (csvfromarray($allfiles,'../model/files.csv')) {
    $msg = "La pièce-jointe a été supprimée";
    if (file_exists('../upload/'.$filetodelete[1])) {
        unlink('../upload/'.$filetodelete[1]);
    }
}
$msg = urlencode($msg);
header('Location: ../index.php?mode=cardviewer&task='.$number.'&msg='.$msg);