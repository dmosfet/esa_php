<!doctype html>
<html lang="fr" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../CSS/pico/pico.min.css">
    <link rel="stylesheet" href="../CSS/style.php">
    <title>Palette de couleur du site</title>
</head>
<body>
<table>
    <caption>
        Couleurs du site
    </caption>
    <thead>
    <tr>
        <th scope="col">Element</th>
        <th scope="col">Type de couleur</th>
        <th scope="col">Couleur</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <?php
        foreach ($colortheme

        as $color) {
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
        $attribut= match ($color['attribut']) {
            'background-color' => "Arrière-plan",
            'border-color' => "Bordure",
        };
        ?>
        <td><?php echo $label; ?></td>
        <td><?php echo $attribut; ?></td>
        <td style="background-color: <?php echo $color['color']; ?>"></td>
    </tr>
    <?php
    }
    ?>
    </tbody>

</table>
<button onclick="window.open('colormenu.php?mode=form','_self', 'width=400 , height=800')">Modifier</button>
<button onclick="refreshAndClose()">Fermer</button>

<script type="text/javascript">
    function refreshAndClose() {
        window.opener.location.reload(true);
        window.close();
    }
</script>
</body>
</html>