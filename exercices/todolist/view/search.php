<?php

$idfindedtasks = $_GET['tasks'] ?? '';
$idfindedtasks = rtrim($idfindedtasks, ';');
$idarray = explode(';', $idfindedtasks);

$alltasks = arrayfromcsv('./model/tasks.csv');
$findedtasks = [];

foreach ($idarray as $id) {
    foreach ($alltasks as $task) {
        if ($task['number'] == $id) {
            $findedtasks[] = $task;
        }
    }
}

if (count($findedtasks) > 0) {
    foreach ($findedtasks as $task) {
        ?>
        <div class="cartouche">
            <a href="index.php?mode=cardviewer&task=<?php echo $task['number'];?>"
               title="<?php echo '#' . $task['number'] . ' - ' . $task['name']; ?>">
                <div class="titrefind"><p><?php echo '#' . $task['number'] . ' - ' . $task['name']; ?></p></div>
            </a>
        </div>
        <?php
    }
} else {
    echo "Aucune tâche trouvée";
}
?>
<form>
    <input type="submit" name="mode" value="Retour">
</form>


