<div class="viewcard">
    <?php
    // Si un message est passé en $_GET (après une action sur la tâche), on l'affiche dans une dialog box
    if (isset($_GET['msg'])) {
        $message = $_GET['msg'];
        ?>
        <dialog open>
            <form method="dialog">
                <div class="dialog">
                    <label><?php echo urldecode($message) ?></label>
                    <button>OK</button>
                </div>
            </form>
        </dialog>
        <?php
    }
    // On récupère les informations de l'utilisateur connecté pour les afficher
    $allusers = arrayfromcsv("./model/users.csv");
    $user = finduser($allusers, $_SESSION['id']);
    ?>
    <fieldset class="card">
        <div class="cardview">
            <div class="cardtitle">
                <h2>
                    <div class="profilepicture">
                        <a href="index.php?mode=user&picture=<?php echo "true"; ?>">
                            <div class="button user" title="Changer la photo de profil"></div>
                        </a>
                    </div>
                    <span><?php echo $user['lastname'] . " " . $user['firstname']; ?></span>
                </h2>
                <p><?php echo "Date de création: " . date('d-m-Y', $user['creation']); ?></p>
            </div>
            <hr>
            <div>
                <?php
                if (isset($_GET['picture']) && $_GET['picture'] == "true") {
                    ?>
                    <form action="./controller/adduserpicture.php" method="post" enctype="multipart/form-data">
                        <legend><b>Uploadez votre fichier :</b></legend>
                        <input type="hidden" name="id" value="<?php echo $_SESSION['id']; ?>">
                        <input type="file" name="nomFile"/>
                        <br/>
                        <input type="submit" name="join" value="Envoyer"/>
                    </form>
                    <hr>
                <?php } ?>
            </div>
            <table>
                <tbody>
                <tr>
                    <th scope="row">Prénom</th>
                    <td><?php echo $user['firstname']; ?></td>
                </tr>
                <tr>
                    <th scope="row">Nom</th>
                    <td><?php echo $user['lastname']; ?></td>
                </tr>
                <tr>
                    <th scope="row">Email</th>
                    <td><?php echo $user['email']; ?></td>
                </tr>
                <tr>
                    <th scope="row">Pseudo Github</th>
                    <td><?php echo $user['pseudo']; ?></td>
                </tr>
                <tr>
                    <th scope="row">Membre de l'équipe</th>
                    <td><?php echo $user['team']; ?></td>
                </tr>
                </tbody>
            </table>

            <form action="index.php" method="get">
                <input type="hidden" name="mode" value="usermodifyer">
                <input type="submit" name="modify" value="Modifier">
            </form>
            <form action="index.php" method="post">
                <input type="submit" name="mode" value="Fermer">
            </form>
    </fieldset>
</div>