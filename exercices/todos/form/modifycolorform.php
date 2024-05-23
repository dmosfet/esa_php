<!doctype html>
<html lang="fr" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../CSS/pico/pico.min.css">
    <link rel="stylesheet" href="../CSS/style.php">
    <title>Tâche à modifier</title>
</head>
<body>
<form action="./action/modifycolor.php" method="post">
    <fieldset>
        <legend>Modifier les couleurs</legend>
        <fieldset>
            <?php
            foreach ($colortheme as $color) {
                $label = match ($color['balise']) {
                    'body' => "Corps du site",
                    '.nouveau' => "Nouvelles tâches",
                    '.encours' => "Tâches démarrées",
                    '.terminé' => "Tâches terminées",
                    '.annulé' => "Tâches annulées",
                    '.cartouche' => "Tâche",
                    '.start' => "Bouton démarrer",
                    '.edit' => "Bouton éditer",
                    '.close' => "Bouton fermer",
                    '.cancel' => "Bouton annuler",
                    '.delete' => "Bouton supprimer",
                    '.dialog' => "Bordure pop-up",
                    '.tag' => "Bordure catégories",
                };
                $element = match ($color['attribut']) {
                'background-color' => "Couleur d'arrière plan",
                'border-color' => "Couleur de la bordure",
                };?>
                <label><?php echo $label . " : " . $element;?></label>
                <input type="color" list="couleurs" name="<?php echo $color['balise'] . "/" . $color['attribut'];?>" placeholder="<?php echo $color['color']; ?>" value="<?php echo $color['color']; ?>"/>
                <datalist id="couleurs">
                    <option value="#20b2aa" title="lightseagreen">Lightseagreen</option>
                    <option value="#008b8b" title="darkcyan">Darkcyan</option>
                    <option value="#f08080" title="lightcoral">Lightcoral</option>
                    <option value="#7fffd4" title="aquamarine">Aquamarine</option>
                    <option value="#08e8de" title="lightcoral">Brighturquoise</option>
                    <option value="#1dacd6" title="aquamarine">Brightcerulean</option>
                    <option value="#ffa500" title="aquamarine">Orange</option>
                </datalist>
            <?php
            }
            ?>
            <input type="submit" name="submit" value="Confirmer">
            <input type="submit" name="close" value="Annuler" onclick="refreshAndClose()">
        </fieldset>
    </fieldset>
</form>

<script type="text/javascript">
    function refreshAndClose() {
        window.opener.location.reload(true);
        window.close();
    }
</script>
</body>
</html>

