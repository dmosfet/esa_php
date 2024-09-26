<?php
$number = $_SESSION['task'];
$allusers = arrayfromcsv('./model/users.csv')
?>
<form action="./controller/addusertask.php" method="post">
    <fieldset class="card">
        <label>Attribuer la tâche à un utilisateur</label>
        <input type="hidden" name="tasknumber" value="<?php echo $number; ?>">
        <input type="text" list="userlist" name="user" value="">
        <datalist id="userlist">
            <?php
            foreach ($allusers as $user) {
                ?>
                <option value="<?php echo $user['firstname'] . " " . $user['lastname'];?>"></option>
            <?php } ?>
        </datalist>
        <br/>
        <input type="submit" name="submit" value="Attribuer"/>
    </fieldset>
</form>