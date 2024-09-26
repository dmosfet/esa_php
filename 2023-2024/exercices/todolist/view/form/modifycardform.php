<?php

// Si un message est passé en $_GET (après une action généralement), on l'affiche dans une dialog box
if (isset($_GET['msg'])) {
    $message = $_GET['msg'];
    ?>
    <dialog open>
        <form method="dialog">
            <div class="dialog">
                <label>
                    <p>Listes des erreurs</p>
                    <?php
                    $errors = explode(',', $message);
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

// Je récupère la tâche à modifier
$tasknumber = $_GET['task'] ?? $_SESSION['task'];
$alltasks = arrayfromcsv("./model/tasks.csv");
$task = findtask($alltasks, $tasknumber);

// Je récupère toutes les catégories existantes
$alltags = arrayfromcsv('./model/tags.csv');

// On prépare les valeurs par défaut de mon formulaire
$number = $task['number'];
$name = $task['name'];
$description = $task['description'];
$status = $task['status'];
$old_status = $task['old_status'];
$creation = !empty($task['creation']) ? date('d-m-Y', $task['creation']) : "";
$start = !empty($task['start']) ? date('d-m-Y', $task['start']) : "";
$due = !empty($task['due']) ? date('d-m-Y', $task['due']) : "";
$closed = !empty($task['closed']) ? date('d-m-Y', $task['closed']) : "";
$cancelled = !empty($task['cancelled']) ? date('d-m-Y', $task['cancelled']) : "";
$tags = $task['tags'];
$user = $task['user'];

?>
<div class="addform">
    <form action="./controller/modifycard.php" method="post">
        <fieldset class="card">
            <legend>Modifier la tâche <?php echo '#' . $tasknumber ?></legend>
            <div class="formview">
                <?php include("card_form_model.php"); ?>
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
