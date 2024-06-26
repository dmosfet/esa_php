<?php

// On récupère toutes les notifications et on les filtres sur base de l'utilisateur connecté actuellement.
$allnotifications = arrayfromcsv("./model/notification.csv");
$notifications = [];

foreach ($allnotifications as $notification) {
    if ($notification['iduser'] == $_SESSION['id']) {
        $notifications[] = $notification;
    }
}
?>

<fieldset class="card">
    <legend class="legendkanban"><span class="button bell"></span>Notifications</legend>
    <div class="notiftable">
        <table>
            <thead>
            <tr>
                <th scope="col">Date</th>
                <th scope="col">Type</th>
                <th scope="col">Voir</th>
            </tr>
            </thead>
            <tbody>
            <?php
            if ($notifications != null) {
                foreach ($notifications as $lign) {
                    // On affiche chaque notification en mettant en évidence les notifications non lues
                    ?>
                    <tr>
                        <td class="<?php if ($lign['status'] == "0") {
                            echo "notread";
                        } else {
                            echo "read";
                        } ?>"><?php echo date('d-m-Y', $lign['timestamp']); ?></td>
                        <td class="<?php if ($lign['status'] == "0") {
                            echo "notread";
                        } else {
                            echo "read";
                        } ?>"><?php echo $lign['type']; ?></td>
                        <td class="<?php if ($lign['status'] == "0") {
                            echo "notread";
                        } else {
                            echo "read";
                        } ?>"><a href="./controller/readnotification.php?id=<?php echo $lign['id']; ?>">voir</a>
                        </td>
                    </tr>
                    <?php
                }
            }
            ?>
            </tbody>
        </table>
    </div>
</fieldset>
<form>
    <input type="submit" name="mode" value="Fermer">
</form>