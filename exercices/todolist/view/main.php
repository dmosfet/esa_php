<?php
$filternew = $_COOKIE['new'] ?? 'taskid_ascsort';
$filterstarted = $_COOKIE['started'] ?? 'taskid_ascsort';
$filterclosed = $_COOKIE['closed'] ?? 'taskid_ascsort';
$filtercancelled = $_COOKIE['cancelled'] ?? 'taskid_ascsort';

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
                <a onclick="window.open('./controller/cancelcard.php?task=<?php echo $task['number']; ?>','local', 'width=400 , height=700')"
                   title="Annuler une tâche">
                    <div class="button cancel"></div>
                </a>
                <a onclick="window.open('./view/form/modifycardform.php?task=<?php echo $task['number']; ?>','local', 'width=400 , height=700')"
                   title="Modifier une tâche">
                    <div class="button edit"></div>
                </a>
                <a onclick="window.open('./controller/startcard.php?task=<?php echo $task['number']; ?>','local', 'width=400 , height=700')"
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
                <a onclick="window.open('./view/form/addcardform.php?status=1','local', 'width=400 , height=700')"
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
                <a onclick="window.open('./view/card.php?task=<?php echo $task['number']; ?>','local', 'width=800 , height=800')"
                   title="<?php echo '#' . $task['number'] . ' - ' . $task['name']; ?>">
                    <div class="titre"><p><?php echo '#' . $task['number'] . ' - ' . $task['name']; ?></p></div>
                </a>
                <a onclick="window.open('./controller/cancelcard.php?task=<?php echo $task['number']; ?>','local', 'width=400 , height=700')"
                   title="Annuler une tâche">
                    <div class="button cancel"></div>
                </a>
                <a onclick="window.open('./view/form/modifycardform.php?task=<?php echo $task['number']; ?>','local', 'width=400 , height=700')"
                   title="Modifier une tâche">
                    <div class="button edit"></div>
                </a>
                <a onclick="window.open('./controller/closecard.php?task=<?php echo $task['number']; ?>','local', 'width=400 , height=700')"
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
                <a onclick="window.open('./view/form/addcardform.php?status=2','local', 'width=400 , height=700')"
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
                <a onclick="window.open('./view/card.php?task=<?php echo $task['number']; ?>','local', 'width=800 , height=800')"
                   title="<?php echo '#' . $task['number'] . ' - ' . $task['name']; ?>">
                    <div class="titre"><p><?php echo '#' . $task['number'] . ' - ' . $task['name']; ?></p></div>
                </a>
                <a onclick="window.open('./view/form/modifycardform.php?task=<?php echo $task['number']; ?>','local', 'width=400 , height=700')"
                   title="Modifier une tâche">
                    <div class="button edit"></div>
                </a>
                <a onclick="window.open('./controller/restorecard.php?task=<?php echo $task['number']; ?>','local', 'width=400 , height=700')"
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
                <a onclick="window.open('./view/form/addcardform.php?status=3','local', 'width=400 , height=700')"
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
                <a onclick="window.open('./view/card.php?task=<?php echo $task['number']; ?>','_blank', 'width=800 , height=800')"
                   title="<?php echo '#' . $task['number'] . ' - ' . $task['name']; ?>">
                    <div class="titre"><p><?php echo '#' . $task['number'] . ' - ' . $task['name']; ?></p></div>
                </a>
                <a onclick="window.open('./controller/deletecard.php?task=<?php echo $task['number']; ?>','local', 'width=400 , height=700')"
                   title="Supprimer une tâche">
                    <div class="button delete"></div>
                </a>
                <a onclick="window.open('./view/form/modifycardform.php?task=<?php echo $task['number']; ?>','local', 'width=400 , height=700')"
                   title="Modifier une tâche">
                    <div class="button edit"></div>
                </a>
                <a onclick="window.open('./controller/restorecard.php?task=<?php echo $task['number']; ?>','local', 'width=400 , height=700')"
                   title="Restaurer une tâche">
                    <div class="button restart"></div>
                </a>
            </div>
            <?php
        }
        ?>
    </fieldset>
</div>