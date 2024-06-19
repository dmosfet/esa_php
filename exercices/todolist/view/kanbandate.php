<?php
$alltasks = arrayfromcsv('./model/tasks.csv');

foreach ($alltasks as $task) {
    if (!empty($task['due']) && $task['due'] < time() && empty($task['closed'])) {
        $latetasks[] = $task;
    } else {
        if (!empty($task['due']) && $task['due'] < time() + 7 * (60 * 60 * 24) && empty($task['closed'])) {
            $urgenttasks[] = $task;
        } else {
            if (!empty($task['due']) && $task['due'] < time() + 30 * (60 * 60 * 24) && empty($task['closed'])) {
                $nexttasks[] = $task;
            } else {
                if (empty($task['due'])) {
                    $notplanifiedtasks[] = $task;
                }
            }
        }
    }
}
?>
<div class="kanban">
    <fieldset class="kanbanbytag">
        <legend class="legendkanban">En retard</legend>
        <?php
        if (empty($latetasks)) {
        ?>
    </fieldset>
    <?php
    } else {
        foreach ($latetasks as $task) {
            ?>
            <div class="cartouche">
                <a href="index.php?mode=cardviewer&task=<?php echo $task['number']; ?>"
                   title="<?php echo '#' . $task['number'] . ' - ' . $task['name']; ?>">
                    <div class="titre">
                        <p>
                            <?php
                            if ($task['status'] == "2") {
                                echo '<del>#' . $task['number'] . ' - ' . $task['name'] . '</del>';
                            } else {
                                echo '#' . $task['number'] . ' - ' . $task['name'];
                            } ?>
                        </p>
                    </div>
                </a>
                <a href="index.php?mode=cardmodifyer&task=<?php echo $task['number']; ?>"
                   title="Modifier une tâche">
                    <div class="button edit"></div>
                </a>
            </div>
            <?php
        }
        ?>
        </fieldset>
        <?php
    }
    ?>
    <fieldset class="kanbanbytag">
        <legend class="legendkanban">Urgent</legend>
        <?php
        if (empty($urgenttasks)) {
        ?>
    </fieldset>
<?php
} else {
    foreach ($urgenttasks as $task) {
        ?>
        <div class="cartouche">
            <a href="index.php?mode=cardviewer&task=<?php echo $task['number']; ?>"
               title="<?php echo '#' . $task['number'] . ' - ' . $task['name']; ?>">
                <div class="titre">
                    <p>
                        <?php
                        if ($task['status'] == "2") {
                            echo '<del>#' . $task['number'] . ' - ' . $task['name'] . '</del>';
                        } else {
                            echo '#' . $task['number'] . ' - ' . $task['name'];
                        } ?>
                    </p>
                </div>
            </a>
            <a href="index.php?mode=cardmodifyer&task=<?php echo $task['number']; ?>"
               title="Modifier une tâche">
                <div class="button edit"></div>
            </a>
        </div>
        <?php
    }
    ?>
    </fieldset>
    <?php
}

?>

    <fieldset class="kanbanbytag">
        <legend class="legendkanban">Dans 30 jours</legend>
        <?php
        if (empty($nexttasks)) {
        ?>
    </fieldset>
<?php
} else {
    foreach ($nexttasks as $task) {
        ?>
        <div class="cartouche">
            <a href="index.php?mode=cardviewer&task=<?php echo $task['number']; ?>"
               title="<?php echo '#' . $task['number'] . ' - ' . $task['name']; ?>">
                <div class="titre">
                    <p>
                        <?php
                        if ($task['status'] == "2") {
                            echo '<del>#' . $task['number'] . ' - ' . $task['name'] . '</del>';
                        } else {
                            echo '#' . $task['number'] . ' - ' . $task['name'];
                        } ?>
                    </p>
                </div>
            </a>
            <a href="index.php?mode=cardmodifyer&task=<?php echo $task['number']; ?>"
               title="Modifier une tâche">
                <div class="button edit"></div>
            </a>
        </div>
        <?php
    }
    ?>
    </fieldset>
    <?php
}
?>
    <fieldset class="kanbanbytag">
        <legend class="legendkanban">Sans échéance</legend>
        <?php
        if (empty($notplanifiedtasks)) {
        ?>
    </fieldset>
<?php
} else {
    foreach ($notplanifiedtasks as $task) {
        ?>
        <div class="cartouche">
            <a href="index.php?mode=cardviewer&task=<?php echo $task['number']; ?>"
               title="<?php echo '#' . $task['number'] . ' - ' . $task['name']; ?>">
                <div class="titre">
                    <p>
                        <?php
                        if ($task['status'] == "2") {
                            echo '<del>#' . $task['number'] . ' - ' . $task['name'] . '</del>';
                        } else {
                            echo '#' . $task['number'] . ' - ' . $task['name'];
                        } ?>
                    </p>
                </div>
            </a>
            <a href="index.php?mode=cardmodifyer&task=<?php echo $task['number']; ?>"
               title="Modifier une tâche">
                <div class="button edit"></div>
            </a>
        </div>
        <?php
    }
    ?>
    </fieldset>
    <?php
}
?>
</div>
