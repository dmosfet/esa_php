<form action="./controller/addfile.php" method="post" enctype="multipart/form-data">
    <legend><b>Uploadez votre fichier :</b></legend>
    <input type="hidden" name="number" value="<?php echo $number;?>">
    <input type="file" name="nomFile"/>
    <br/>
    <input type="submit" name="join" value="Envoyer"/>
</form>