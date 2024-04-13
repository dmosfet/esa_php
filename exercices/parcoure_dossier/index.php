<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Liste des fichiers dans le dossier en cours</title>
    <link href="./css/style.css" rel="stylesheet">
</head>

<?php

// récupère l'adresse du dossier racine

$pointeur = opendir($_SERVER["DOCUMENT_ROOT"]);

echo "Liste des fichiers dans le dossier racine du serveur PHP en cours d'éxécution:";

?>

<ol class="liste_fichiers">

    <?php
 while (false != ($monfichier = readdir($pointeur))) {;
     // si c'est un dossier en gras, si un fichier en bleu italic via le CSS
     if (is_dir($_SERVER["DOCUMENT_ROOT"] . "\\" .$monfichier)) {
         ?> <li class="directory">
             <?php } else { ?>
            <li class = "file">
     <?php }
     echo $monfichier; ?>
            </li>
    <?php }

closedir($pointeur);

?>
</ol>
</html>

