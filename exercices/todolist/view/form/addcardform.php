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

// Je récupère les tâches pour déterminer le numéro de tâche le plus important
$allstaks = readcsv( './model/tasks.csv');
$nextnumber = nextnumber($allstaks);

// Je récupère les tâches supprimées pour déterminer le numéro de tâche le plus important
$alldeletedstaks = readcsv( './model/deletedtasks.csv');
$nextnumberdeleted = nextnumber($alldeletedstaks);

// Je garde le chiffre le plus élevé. Je ne veux pas de tâches qui portent le même numéro.
if ($nextnumber < $nextnumberdeleted) {
    $nextnumber = $nextnumberdeleted;
}

$alltags = arrayfromcsv('./model/tags.csv');

$number = $nextnumber;
$name = "";
$description = "";
$status = $_GET["status"] ?? "0";
$old_status = $_GET["status"] ?? "0";
$creation = date("d-m-Y");
$start = "";
$due = "";
$closed = "";
$cancelled = "";
$tags = "";
$user ="";

?>
<div class="addform">
    <form action="./controller/addcard.php" method="post">
        <fieldset class="card">
            <div class="formview">
                <legend>Ajouter une nouvelle tâche</legend>
                <?php include('card_form_model.php'); ?>
                <input type="submit" name="submit" value="Ajouter"/>
            </div>
        </fieldset>
    </form>
    <form action="index.php" method="post">
        <input type="submit" name="submit" value="Annuler"/>
    </form>
</div>