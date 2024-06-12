<form action="./controller/addcomment.php" method="post">
    <legend><b>Ajouter votre commentaire :</b></legend>
    <input type="hidden" name="id" value="<?php echo $lastidcomment;?>">
    <input type="hidden" name="tasknumber" value="<?php echo $number;?>">
    <input type="textarea" name="comment"/>
    <br/>
    <input type="submit" name="join" value="Envoyer"/>
</form>