<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        table, tr,td,th {
            border: 1px solid black;
            width: 33%;
        }
    </style>
</head>
<body>

<?php
function affiche($var1, $var2) {
    echo "<tr><td>$var1</td><td>$var2</td></tr>";
}

// matrice de 3x2
$tableau[0][0] = 2;
$tableau[0][1] = 4;
$tableau[1][0] = 6;
$tableau[1][1] = 8;
$tableau[2][0] = 10;
$tableau[2][1] = 12;

?>

<table>

    <?php
    affiche ($tableau[0][0], $tableau[0][1]);
    affiche ($tableau[1][0], $tableau[1][1]);
    affiche ($tableau[2][0], $tableau[2][1]);
    ?>
</table>

</body>
</html>