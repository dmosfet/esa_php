<?php ob_start()?>
<!doctype html>
<html lang="fr" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tâche</title>
</head>
<body>
<?php include("../function.php");
$number = $_GET['task'];
$file = $_GET['file'];

$piecesjointes = findfilefromtasknumber('../files.csv', $number);
$allfiles = arrayfromcsv('../files.csv');

foreach ($piecesjointes as $piecejointe) {
        if ($piecejointe[1] == $file) {
            $filetodelete = $piecejointe;
            break;
        }
}

// retourne la position de la tâche dans la liste
$position = array_search($filetodelete, $allfiles);
// On garde le nom du fichier pour la suppression
unset($allfiles[$position]);

// réécrit le fichier csv
$msg = "La pièce-jointe n'a pu être supprimée";

if (csvfromarray($allfiles,'../files.csv')) {
    $msg = "La pièce-jointe a été supprimée";
    if (file_exists('../upload/'.$filetodelete[1])) {
        unlink('../upload/'.$filetodelete[1]);
    }
}

$msg = urlencode($msg);
header('Location: ../view/card.php?task='.$number.'&msg='.$msg);
?>

</body>
</html>