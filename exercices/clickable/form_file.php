<?php

echo '<h1>Elements récupérés</h1>';

echo 'Nom fichier origine :' . $_FILES['nomFile']['name'] .'<br />';
echo 'Taille :' . $_FILES['nomFile']['size'] .'<br />';
echo 'Nom temporaire du fichier :' . $_FILES['nomFile']['tmp_name'] .'<br />';
echo 'Type du fichier :' . $_FILES['nomFile']['type'] .'<br />';
echo 'Erreur de téléchargement :' . $_FILES['nomFile']['error'] .'<br />';

$destination ='./'.$_FILES['nomFile']['name'];

move_uploaded_file($_FILES['nomFile']['tmp_name'], $destination);