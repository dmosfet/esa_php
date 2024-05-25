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

</body>
</html>
<form action="../action/addfile.php" method="post" enctype="multipart/form-data">
    <legend><b>Uploadez votre fichier :</b></legend>
    <input type="hidden" name="number" value="<?php echo $number;?>">
    <input type="file" name="nomFile"/>
    <br/>
    <input type="submit" name="join" value="Envoyer"/>
</form>