<?php
$alltags = readcsv('./model/tags.csv');
$nextnumber = nextnumber($alltags);
?>
<div class="addform">
    <form action="./controller/addtag.php" method="post">
            <input type="hidden" name="number"  placeholder="Numéro" value="<?php echo $nextnumber; ?>">
            <input type="text" name="name"  placeholder="Nom" value="" pattern="[A-Za-zà-üÀ-Ü]+" required>
            <input type="color" name="color"  placeholder="color" value="" required>
            <input type="submit" name="Confirmer"/>
    </form>
</div>

