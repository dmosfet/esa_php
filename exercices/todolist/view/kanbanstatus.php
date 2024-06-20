<?php
// On récupère le type de tri utilisé pour chaque status. Ils sont stockés dans des cookies
$filternew = $_COOKIE['new'] ?? 'taskid_ascsort';
$filterstarted = $_COOKIE['started'] ?? 'taskid_ascsort';
$filterclosed = $_COOKIE['closed'] ?? 'taskid_ascsort';
$filtercancelled = $_COOKIE['cancelled'] ?? 'taskid_ascsort';

// On récupère les tâches. On les répartis en fonction de leur statut (0, 1, 2, 3)
$alltasks = arrayfromcsv('./model/tasks.csv');
?>
<div class="kanban">
    <fieldset class="nouveau">
        <legend class="legendkanban">Back log
            <div class="action">
                <a href="index.php?mode=addcard&status=0"
                   title="Créer une tâche dans ce menu">
                    <div class="button create"></div>
                </a>
            </div>
        </legend>
        <?php
        $newtasks = statusfilteredarray($alltasks, "0");
        switch ($filternew) {
            case 'taskid_ascsort':
                usort($newtasks, 'taskid_ascsort');
                break;
            case 'taskid_descsort':
                usort($newtasks, 'taskid_descsort');
                break;
            case 'taskname_ascsort':
                usort($newtasks, 'taskname_ascsort');
                break;
            case 'taskname_descsort':
                usort($newtasks, 'taskname_descsort');
                break;
        }
        foreach ($newtasks as $task) {
            ?>
            <div class="cartouche">
                <a href="index.php?mode=cardviewer&task=<?php echo $task['number'];?>"
                   title="<?php echo '#' . $task['number'] . ' - ' . $task['name']; ?>">
                    <div class="titre"><p><?php echo '#' . $task['number'] . ' - ' . $task['name']; ?></p></div>
                </a>
                <a href="./controller/cancelcard.php?task=<?php echo $task['number']; ?>"
                   title="Annuler une tâche">
                    <div class="button cancel"></div>
                </a>
                <a href="index.php?mode=cardmodifyer&task=<?php echo $task['number']; ?>"
                   title="Modifier une tâche">
                    <div class="button edit"></div>
                </a>
                <a href="./controller/startcard.php?task=<?php echo $task['number']; ?>"
                   title="Démarrer une tâche">
                    <div class="button start"></div>
                </a>
            </div>
            <?php
        }
        ?>
    </fieldset>
    <fieldset class="encours">
        <legend class="legendkanban">En cours
            <div class="action">
                <a href="index.php?mode=addcard&status=1"
                   title="Créer une tâche dans ce menu">
                    <div class="button create"></div>
                </a>
            </div>
        </legend>
        <?php
        $startedtasks = statusfilteredarray($alltasks, "1");
        switch ($filterstarted) {
            case 'taskid_ascsort':
                usort($startedtasks, 'taskid_ascsort');
                break;
            case 'taskid_descsort':
                usort($startedtasks, 'taskid_descsort');
                break;
            case 'taskname_ascsort':
                usort($startedtasks, 'taskname_ascsort');
                break;
            case 'taskname_descsort':
                usort($startedtasks, 'taskname_descsort');
                break;
        }
        foreach ($startedtasks as $task) {
            ?>
            <div class="cartouche">
                <a href="index.php?mode=cardviewer&task=<?php echo $task['number'];?>"
                   title="<?php echo '#' . $task['number'] . ' - ' . $task['name']; ?>">
                    <div class="titre"><p><?php echo '#' . $task['number'] . ' - ' . $task['name']; ?></p></div>
                </a>
                <a href="./controller/cancelcard.php?task=<?php echo $task['number']; ?>"
                   title="Annuler une tâche">
                    <div class="button cancel"></div>
                </a>
                <a href="index.php?mode=cardmodifyer&task=<?php echo $task['number']; ?>"
                   title="Modifier une tâche">
                    <div class="button edit"></div>
                </a>
                <a href="./controller/closecard.php?task=<?php echo $task['number']; ?>"
                   title="Terminer une tâche">
                    <div class="button close"></div>
                </a>

            </div>
            <?php
        }
        ?>
    </fieldset>
    <fieldset class="terminé">
        <legend class="legendkanban">Terminé
            <div class="action">
                <a href="index.php?mode=addcard&status=2"
                   title="Créer une tâche dans ce menu">
                    <div class="button create"></div>
                </a>
            </div>
        </legend>
        <?php
        $closedtasks = statusfilteredarray($alltasks, "2");
        switch ($filterclosed) {
            case 'taskid_ascsort':
                usort($closedtasks, 'taskid_ascsort');
                break;
            case 'taskid_descsort':
                usort($closedtasks, 'taskid_descsort');
                break;
            case 'taskname_ascsort':
                usort($closedtasks, 'taskname_ascsort');
                break;
            case 'taskname_descsort':
                usort($closedtasks, 'taskname_descsort');
                break;
        }
        foreach ($closedtasks as $task) { ?>
            <div class="cartouche">
                <a href="index.php?mode=cardviewer&task=<?php echo $task['number'];?>"
                   title="<?php echo '#' . $task['number'] . ' - ' . $task['name']; ?>">
                    <div class="titre"><p><?php echo '<del>#' . $task['number'] . ' - ' . $task['name'] .'</del>'; ?></p></div>
                </a>
                <a href="index.php?mode=cardmodifyer&task=<?php echo $task['number']; ?>"
                   title="Modifier une tâche">
                    <div class="button edit"></div>
                </a>
                <a href="./controller/restorecard.php?task=<?php echo $task['number']; ?>"
                   title="Restaurer une tâche">
                    <div class="button restart"></div>
                </a>
            </div>
            <?php
        }
        ?>
    </fieldset>
    <fieldset class="annulé">
        <legend class="legendkanban">Annulé
            <div class="action">
                <a href="index.php?mode=addcard&status=3"
                   title="Créer une tâche dans ce menu">
                    <div class="button create"></div>
                </a>
            </div>
        </legend>
        <?php
        $cancelledtasks = statusfilteredarray($alltasks, "3");
        switch ($filtercancelled) {
            case 'taskid_ascsort':
                usort($cancelledtasks, 'taskid_ascsort');
                break;
            case 'taskid_descsort':
                usort($cancelledtasks, 'taskid_descsort');
                break;
            case 'taskname_ascsort':
                usort($cancelledtasks, 'taskname_ascsort');
                break;
            case 'taskname_descsort':
                usort($cancelledtasks, 'taskname_descsort');
                break;
        }
        foreach ($cancelledtasks as $task) { ?>
            <div class="cartouche">
                <a href="index.php?mode=cardviewer&task=<?php echo $task['number'];?>"
                   title="<?php echo '#' . $task['number'] . ' - ' . $task['name']; ?>">
                    <div class="titre"><p><?php echo '#' . $task['number'] . ' - ' . $task['name']; ?></p></div>
                </a>
                <a href="./controller/deletecard.php?task=<?php echo $task['number']; ?>"
                   title="Supprimer une tâche">
                    <div class="button delete"></div>
                </a>
                <a href="index.php?mode=cardmodifyer&task=<?php echo $task['number']; ?>"
                   title="Modifier une tâche">
                    <div class="button edit"></div>
                </a>
                <a href="./controller/restorecard.php?task=<?php echo $task['number']; ?>"
                   title="Restaurer une tâche">
                    <div class="button restart"></div>
                </a>
            </div>
            <?php
        }
        ?>
    </fieldset>
</div>