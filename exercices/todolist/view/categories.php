<?php
// Affiche les différentes catégories dans une table
$alltags = arrayfromcsv('./model/tags.csv');
$colortheme = arrayfromcsv('./model/colortheme.csv');

?>
<div class="viewtag">
    <fieldset class="card">
        <legend class="legendkanban"><span class="button categories"></span>Catégories</legend>
        <div class="tagtable">
            <table>
                <thead>
                <tr>
                    <th scope="col">Numéro</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Couleur</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <?php foreach ($alltags

                    as $tag) {
                    ?>
                    <th><?php echo $tag['number']; ?></th>
                    <td><?php echo $tag['name']; ?></td>
                    <td style="background-color: <?php echo $tag['color']; ?>"></td>
                </tr>
                <?php
                }
                ?>
                </tbody>
            </table>
        </div>
        <div class="tagform">
                <a href="index.php?mode=settings&view=addtag"
                   title="Ajouter une catégorie">
                    <div class="addtag"></div>
                </a>
                <p>Ajouter une nouvelle catégorie</p>
            <?php
            if ($_GET['view'] == "addtag") {
                include('./view/form/addtagform.php');
            } ?>
        </div>
    </fieldset>
</div>

