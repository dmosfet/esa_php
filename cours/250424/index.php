<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<?php
if (isset($_GET['msg'])){
    $message = $_GET['msg'];
    echo "<script type='text/javascript'>alert('$message');</script>";
}
?>


<form action="recuperation_php.php" method="post">
    <fieldset>
        <legend><b>Mon premier formulaire PHP</b></legend>
        <label>Nom:</label>
            <input type="text" name="nom"/>
        <label>Pr&eacutenom</label>
            <input type="text" name="prenom"/>
        <input type="submit" name="Envoyer" />
    </fieldset>
</form>

<form action="couleurs.php" method="post">
    <fieldset>
        <legend><b>Mon deuxième formulaire PHP</b></legend>
        <label>Texte à coloriser:</label>
        <input type="text" name="texte"/>
        <input type="submit" name="Envoyer" />
    </fieldset>
</form>

</body>
</html>


