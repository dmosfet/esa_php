<?php
if (isset($_GET['msg'])) {
$message = $_GET['msg'];
?>
<dialog open>
    <form method="dialog">
        <div class="dialog">
            <label>
                <p>Listes des erreurs</p>
                <?php
                $errors=explode(',', $message);
                foreach ($errors as $error) {
                    echo $error . "<br>";
                }
                ?>
            </label>
            <button>OK</button>
        </div>
    </form>
</dialog>
<?php
}

$id = $_GET['id'] ?? $_SESSION['id'];
$allusers= arrayfromcsv("./model/users.csv");
$user = finduser($allusers, $id);

$firstname = $user['firstname'];
$lastname = $user['lastname'];
$pseudo = $user['pseudo'];
$email = $user['email'];
$password = $user['password'];
$creation = $user['creation'];
$team = $user['team'];

?>
<div class="addform">
    <form action="./controller/modifyuser.php" method="post">
        <fieldset class="card">
            <legend>Modifier l'utilisateur <?php echo '#' . $id ?></legend>
            <div class="formview">
                <input type="hidden" name="id" placeholder="" value="<?php echo $id; ?>"/>
                <input type="hidden" name="email" placeholder="" value="<?php echo $email; ?>"/>
                <input type="hidden" name="password" placeholder="" value="<?php echo $password; ?>"/>
                <input type="text" name="lastname" placeholder="Nom" value="<?php echo $lastname; ?>"
                       pattern="[A-Za-zà-üÀ-Ü\-\!\'\s]+" required/>
                <input type="text" name="firstname" placeholder="Prénom" value="<?php echo $firstname; ?>" required
                       pattern="[A-Za-zà-üÀ-Ü\-\!\'\s]+"/>
                <input type="text" name="pseudo" placeholder="Pseudo" value="<?php echo $pseudo; ?>"
                       pattern="[A-Za-zà-üÀ-Ü\-\!\'\s]+" required/>
                <input type="hidden" name="creation" placeholder="" value="<?php echo $creation ?>"/>
                <input type="hidden" name="team" placeholder="" value="<?php echo $team?>"/>

                <fieldset>
                    <input type="submit" name="submit" value="Confirmer">
                </fieldset>
            </div>
        </fieldset>
    </form>
    <form action="index.php" method="get">
        <fieldset class="card">
            <input type="submit" name="mode" value="Annuler">
        </fieldset>
    </form>
</div>
