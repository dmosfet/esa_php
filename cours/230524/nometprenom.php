<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
    <title>Quels sont leurs prénoms</title>
</head>
<body>

<?php
$nbrenfant = $_POST['number'];
?>
<form action="afficheprenom.php" method="post">
    <label>Pourriez-vous préciser le nom et prénom de vos <?php echo $nbrenfant; ?> enfants ?</label>
    <?php for ($i = 0; $i < $nbrenfant; $i++): ?>
        <label>Nom de votre enfant numéro <?php echo $i;?>
        <input type="text" name="<?php echo "nom" . $i;?>">
        </label>
        <label>Prénom de votre enfant numéro <?php echo $i;?>
        <input type="text" name="<?php echo "prenom" . $i;?>">
        </label>
    <?php endfor; ?>
    <input type="hidden" name="number" value="<?php echo $nbrenfant;?>">
    <input type="submit" name="Envoyer">
</form>
</body>
</html>
