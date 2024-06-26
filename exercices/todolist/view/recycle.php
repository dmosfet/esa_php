<?php

// On récupère les tâches supprimées (statut = -1)
$deletedtask = [];
$alltasks = arrayfromcsv("./model/tasks.csv");

foreach ($alltasks as $task) {
    if ($task['status'] == "-1") {
        $deletedtask[] = $task;
    }
}

if ($deletedtask != null) {
    foreach ($deletedtask as $task) {
        // On affiche chaque tâche avce l'option de la lire, de la supprimer, ou de la restaurer
        ?>
        <div class="cartouche">
            <a href="index.php?mode=cardviewer&task=<?php echo $task['number']; ?>"
               title="<?php echo '#' . $task[0] . ' - ' . $task[1]; ?>">
                <div class="titrerecycle"><p><?php echo '#' . $task['number'] . ' - ' . $task['name']; ?></p></div>
            </a>
            <a href="./controller/definitelydeletecard.php?task=<?php echo $task['number']; ?>"
               title="Supprimer définitivement une tâche">
                <div class="button delete"></div>
            </a>
            <a href="./controller/restorecard.php?task=<?php echo $task['number']; ?>"
               title="Restaurer une tâche">
                <div class="button start"></div>
            </a>
        </div>
        <?php
    }
} else {
    echo "Il n'y a pas de tâche supprimée dans la poubelle actuellement";
}
?>
<form>
    <input type="submit" name="mode" value="Fermer">
</form>