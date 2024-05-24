<?php ob_start();?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<?php

// Si une valeur $_POST existe, je la récupère et je l'utilise pour set un cookie. Je l'utilise pour changer le fond
// sinon
// Si un cookie existe, j'utilise sa valeur pour changer le fond d'écran, sinon je choisi le blanc.

if (isset($_POST['color'])) {
    setcookie("color", $_POST['color'], time() + (30), "/");
    $color = $_POST['color'];
} else {
    if (isset($_COOKIE["color"])) {
        $color = $_COOKIE["color"];
    } else {
        $color= "white";
    }
}

?>

<body style="background-color: <?php echo $color?>;">
<h1><?php echo rand(1,20);?></h1>
<form action="" method="post">
    <label>Merci de choisir une couleur de fond d'écran
        <select name="color" id="listecouleurs">
            <option value="lightseagreen">Light Sea Green</option>
            <option value="darkcyan">Dark cyan</option>
            <option value="aquamarine">Aquamarine</option>
            <option value="lightcoral">Light coral</option>
        </select>
    </label>
    <input type="submit" name="submit">
</form>

</body>
</html>
