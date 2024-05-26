<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
    <link rel="stylesheet" href="../CSS/style.php">
    <title>Ajouter une nouvelle tâche</title>
</head>
<body>
<?php
include('../function.php');

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

$allstaks = readcsv('../tasks.csv');
$nextnumber = lastnumber($allstaks) + 1;
$alltags = arrayfromcsv('../tags.csv');

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
    <form action="../action/addcard.php" method="post">
        <fieldset class="card">
            <div class="formview">
                <legend>Ajouter une nouvelle tâche</legend>
                <?php include('../model/card_form_model.php'); ?>
                <input type="submit" name="Confirmer"/>
            </div>
        </fieldset>
    </form>
</div>
</body>
</html>
