<form action="./controller/addlist.php" method="post">
    <legend><b>Ajouter une entrée à votre liste :</b></legend>
    <input type="hidden" name="number" value="<?php echo $number;?>">
    <input type="text" name="entry"/>
    <br/>
    <input type="submit" name="join" value="Ajouter"/>
</form>
