<!DOCTYPE html>
<html>

<head>
    <title>Damier de 8x8</title>
    <link href="./css/style.css" rel="stylesheet">
</head>

<body>

<form action="damier.php" method="post">
    <ul>
        <li>
            <label>Couleur case impaire</label>
            <select name="couleurA" id="couleurA">
                <option valeur="white">white</option>
                <option valeur="black">black</option>
                <option valeur="red">red</option>
                <option valeur="yellow">yellow</option>
                <option valeur="blue">blue</option>
                <option valeur="green">green</option>
            </select>
        </li>
        <li>
            <label>Couleur case paire</label>
            <select name="couleurB" id="couleurB">
                <option valeur="white">white</option>
                <option valeur="black">black</option>
                <option valeur="red">red</option>
                <option valeur="yellow">yellow</option>
                <option valeur="blue">blue</option>
                <option valeur="green">green</option>
            </select>
        </li>
    </ul>

    <div class="button">
        <button type="submit">Changer les couleurs</button>
    </div>

</form>

<div class="damier">

    <?php
    $couleurA = $_POST["couleurA"] ?? "white";
    $couleurB = $_POST["couleurB"] ?? "black";

    // Boucle sur les lignes
    for ($i = 1; $i <= 8; $i++) {
        // Boucle sur les colonnes
        for ($j = 1; $j <= 8; $j++) {
            // On alterne les cases paires et impaires, on décale à chaque changement de ligne
            if (($j + $i) % 2 == 0) {
                ?>
                <div class="case <?php echo $couleurA; ?>"></div>
                <?php
            } else {
                ?>
                <div class="case <?php echo $couleurB; ?>"></div>
                <?php
            }
        }
    }
    ?>
</div>
</body>
</html>
