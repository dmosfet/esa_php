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

$allstaks = readcsv( './model/tasks.csv');
$nextnumber = nextnumber($allstaks);
$alltags = arrayfromcsv('./model/tags.csv');

$number = $nextnumber;
$name = "";
$description = "";
$status = isset($_GET["status"]) ? $_GET["status"] : "0";
$old_status = isset($_GET["status"]) ? $_GET["status"] : "0";
$creation = date("d-m-Y");
$start = "";
$due = "";
$closed = "";
$cancelled = "";
$tags = "";

?>
<div class="addform">
    <form action="./controller/addcard.php" method="post">
        <fieldset class="card">
            <div class="formview">
                <legend>Ajouter une nouvelle tâche</legend>
                <?php include('card_form_model.php'); ?>
                <input type="submit" name="Confirmer"/>
            </div>
        </fieldset>
    </form>
</div>