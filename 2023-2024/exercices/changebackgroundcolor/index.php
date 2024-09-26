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
            <option value="lightseagreen" <?php if ($color="lightseagreen") { echo 'selected="selected"';}?>>Light Sea Green</option>
            <option value="darkcyan" <?php if ($color="darkcyan") { echo 'selected="selected"';}?>>Dark cyan</option>
            <option value="aquamarine" <?php if ($color="aquamarine") { echo 'selected="selected"';}?>>Aquamarine</option>
            <option value="lightcoral" <?php if ($color="lightcoral") { echo 'selected="selected"';}?>>Light coral</option>
            <option value="blueviolet" <?php if ($color="blueviolet") { echo 'selected="selected"';}?>>Blue Violet</option>
            <option value="darkslategrey" <?php if ($color="darkslategrey") { echo 'selected="selected"';}?>>DarkSlateGrey</option>
            <option value="olive" <?php if ($color="olive") { echo 'selected="selected"';}?>>Olive</option>
        </select>
    </label>
    <input type="submit" name="submit">
</form>

</body>
</html>
