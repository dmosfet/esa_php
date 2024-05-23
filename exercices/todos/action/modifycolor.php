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
<?php
include("../function.php");

// On récupère les données du formulaire envoyées depuis ../form/modifycardform.php
$formcolors= $_POST;

// On supprime l'input "submit" du formulaire reçu
unset($formcolors['submit']);

$newcolor=[];
$updatedcolors=[];

foreach ($formcolors as $key => $value) {
    $newkeys=explode("/",$key);
    $newcolor['balise'] = str_replace('_','.',$newkeys[0]);
    $newcolor['attribut'] = $newkeys[1];
    $newcolor['color'] = $value;
    $updatedcolors[] = $newcolor;
}

// On réécrit la mise à jour dans le fichier CSV
$msg = "Modification annulée";
if (csvfromarray($updatedcolors,'../colortheme.csv')){
    $msg="Modification réalisée";
}

$msg = urlencode($msg);

// On retourne en mode vue pour afficher les changements
header('Location: ../colormenu.php?mode=view&msg='.$msg);

?>
</body>
</html>

