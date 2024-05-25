<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="../action/addcomment.php" method="post">
    <legend><b>Ajouter votre commentaire :</b></legend>
    <input type="hidden" name="number" value="<?php echo $number;?>">
    <input type="textarea" name="comment"/>
    <br/>
    <input type="submit" name="join" value="Envoyer"/>
</form>
</body>
</html>