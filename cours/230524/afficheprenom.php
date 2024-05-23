<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
    <title>Affichage des noms et prénoms des enfants</title>
</head>
<body>
<?php
$nbrenfant = $_POST['number'];
for ($i = 0; $i < $nbrenfant; $i++) {
    ?>
    <p>Nom: <?php echo $_POST['nom'.$i];?></p>
    <p>Prénom: <?php echo $_POST['prenom'.$i];?></p>
<?php
}
?>
</body>
</html>
