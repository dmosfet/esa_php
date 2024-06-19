<?php

$alltasks = arrayfromcsv('./model/tasks.csv');
$alltags = arrayfromcsv('./model/tags.csv');
?>
<div class="kanban">

    <?php

    if ($alltags != NULL) {
        foreach ($alltags as $tag) {
            ?>
            <fieldset class="kanbanbytag">
                <legend class="legendkanban"><?php echo $tag['name']; ?></legend>
                <?php
                foreach ($alltasks as $task) {
                    if (str_contains($task['tags'], $tag['name'])) { ?>
                        <div class="cartouche">
                            <a href="index.php?mode=cardviewer&task=<?php echo $task['number']; ?>"
                               title="<?php echo '#' . $task['number'] . ' - ' . $task['name']; ?>">
                                <div class="titre">
                                    <p>
                                        <?php
                                        if ($task['status']=="2") {
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

                }
                ?>
            </fieldset>
            <?php
        }
        ?>
        <fieldset class="kanbanbytag">
            <legend class="legendkanban">Sans catégories</legend>
            <?php
            foreach ($alltasks as $task) {
                if (empty($task['tags'])) { ?>
                    <div class="cartouche">
                        <a href="index.php?mode=cardviewer&task=<?php echo $task['number']; ?>"
                           title="<?php echo '#' . $task['number'] . ' - ' . $task['name']; ?>">
                            <div class="titre">
                                <p>
                                    <?php
                                    if ($task['status']=="2") {
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

            }
            ?>
        </fieldset>
        <?php

    } else {
        echo "Aucune catégorie n'a été définie dans votre kanban";
    }
    ?>

