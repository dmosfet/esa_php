<div class="colorview">
    <fieldset class="card">
        <legend class="legendkanban"><span class="button colors"></span>Couleurs du site</legend>
        <div class="colortable">
            <table>
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
                    $colortheme = arrayfromcsv("./model/colortheme.csv");
                    foreach ($colortheme

                    as $color) {
                    $label = match ($color['balise']) {
                        'body' => "Corps du site",
                        '.nouveau' => "Nouvelles tâches",
                        '.encours' => "Tâches démarrées",
                        '.terminé' => "Tâches terminées",
                        '.annulé' => "Tâches annulées",
                        '.cartouche' => "Tâche",
                        '.card' => "Vue tâche",
                        '.start' => "Bouton démarrer",
                        '.restart' => "Bouton restaurer",
                        '.edit' => "Bouton éditer",
                        '.close' => "Bouton fermer",
                        '.cancel' => "Bouton annuler",
                        '.delete' => "Bouton supprimer",
                        '.dialog' => "Bordure pop-up",
                        '.tag' => "Bordure catégories",
                    };
                    $attribut = match ($color['attribut']) {
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
            <div>
                <form action="index.php" method="get">
                    <input type="hidden" name="mode" value="modifycolor">
                    <input type="submit" value="Modifier"/>
                </form>
            </div>
        </div>
    </fieldset>
</div>