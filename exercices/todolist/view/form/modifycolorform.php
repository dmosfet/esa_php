<div class="modifycolor">
    <form action="./controller/modifycolor.php" method="post">
        <fieldset class="card">
            <legend>Modifier les couleurs</legend>
            <fieldset class="colorform">
                <?php
                $colortheme = arrayfromcsv("./model/colortheme.csv");
                foreach ($colortheme as $color) {
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
                    $element = match ($color['attribut']) {
                        'background-color' => "Couleur d'arrière plan",
                        'border-color' => "Couleur de la bordure",
                    }; ?>
                    <label><?php echo $label . " : " . $element; ?></label>
                    <input type="color" list="couleurs"
                           name="<?php echo $color['balise'] . "/" . $color['attribut']; ?>"
                           placeholder="<?php echo $color['color']; ?>" value="<?php echo $color['color']; ?>"/>
                    <datalist id="couleurs">
                        <option value="#20b2aa" title="lightseagreen">Lightseagreen</option>
                        <option value="#008b8b" title="darkcyan">Darkcyan</option>
                        <option value="#f08080" title="lightcoral">Lightcoral</option>
                        <option value="#7fffd4" title="aquamarine">Aquamarine</option>
                        <option value="#08e8de" title="brightturquoise">Brighturquoise</option>
                        <option value="#1dacd6" title="brightcerulean">Brightcerulean</option>
                        <option value="#ffa500" title="orange">Orange</option>
                    </datalist>
                    <?php
                }
                ?>
                <input type="submit" name="submit" value="Confirmer">

            </fieldset>

        </fieldset>
    </form>
    <form action="index.php" method="get">
        <input type="hidden" name="mode" value="settings">
        <input type="submit" name="action" value="Annuler">
    </form>
</div>