<?php
$allusers = readcsv('./model/users.csv');
$nextnumber = nextnumber($allusers);
?>
<div class="addform">
    <form action="./controller/adduser.php" method="post">
        <input type="hidden" name="id" placeholder="Numéro" value="<?php echo $nextnumber; ?>">
        <input type="text" name="lastname" placeholder="Nom" value="" required>
        <input type="text" name="firstname" placeholder="Prénom" value="" required>
        <input type="text" name="email" placeholder="Email" value="" required>
        <input type="password" name="password" placeholder="Mot de passe" value="" required>
        <input type="submit" name="Confirmer"/>
    </form>
</div>

