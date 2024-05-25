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
$comment = $_GET['comment'];

$commentaires = findcommentsfromtasknumber('../comments.csv', $number);
$allcomments = arrayfromcsv('../comments.csv');

foreach ($commentaires as $commentaire) {
        if ($commentaire[1] == $comment) {
            $commenttodelete = $commentaire;
            break;
        }
}

// retourne la position de la tâche dans la liste
$position = array_search($commenttodelete, $allcomments);
// On garde le nom du fichier pour la suppression
unset($allcomments[$position]);

// réécrit le fichier csv
$msg = "Le commentaire n'a pu être supprimé";

if (csvfromarray($allcomments,'../comments.csv')) {
    $msg = "Le commentaire a été supprimé";
}

$msg = urlencode($msg);
header('Location: ../view/card.php?task='.$number.'&msg='.$msg);
?>

</body>
</html>