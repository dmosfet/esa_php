<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
    <link rel="stylesheet" href="CSS/style.php">
    <title>Gestionnaire de tâches</title>
</head>
<header>
    <h2>Planificateur de tâches
        <a onclick="window.open('./view/recycle.php','local', 'width=400 , height=800')"
           title="Consulter les tâches supprimées">
            <div class="bin"></div>
        </a>
        <a onclick="window.open('./form/searchcardform.php','local', 'width=400 , height=332')"
           title="Rechercher une tâche">
            <div class="search"></div>
        </a>
        <a onclick="window.open('./view/categories.php','local', 'width=800 , height=900')"
           title="Gestionnaire de catégories">
            <div class="categories"></div>
        </a>
        <a onclick="window.open('./colormenu.php?mode=view','local', 'width=800 , height=900')"
           title="Consulter la palette de couleurs">
            <div class="colors"></div>
        </a>
        <a onclick="window.open('./view/statistiques.php?mode=view','local', 'width=800 , height=900')"
           title="Consulter les statistiques">
            <div class="chart"></div>
        </a>
    </h2>
</header>
<body>
<?php
include('function.php');

$filternew = $_COOKIE['new'] ?? 'taskid_ascsort';
$filterstarted = $_COOKIE['started'] ?? 'taskid_ascsort';
$filterclosed = $_COOKIE['closed'] ?? 'taskid_ascsort';
$filtercancelled = $_COOKIE['cancelled'] ?? 'taskid_ascsort';

$alltasks = arrayfromcsv('tasks.csv')

?>
<div class="kanban">
    <fieldset class="nouveau">
        <legend class="legendkanban">Back log
            <div class="action">
                <a onclick="window.open('./form/addcardform.php?status=0','local', 'width=400 , height=700')"
                   title="Créer une tâche dans ce menu">
                    <div class="button create"></div>
                </a>
                <a onclick="window.open('./form/filtermenuform.php?kanban=new','local', 'width=400 , height=332')"
                   title="Filtrer">
                    <div class="button filter"></div>
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
                <a onclick="window.open('./view/card.php?task=<?php echo $task['number']; ?>','local', 'width=200 , min-height=300')"
                   title="<?php echo '#' . $task['number'] . ' - ' . $task['name']; ?>">
                    <div class="titre"><p><?php echo '#' . $task['number'] . ' - ' . $task['name']; ?></p></div>
                </a>
                <a onclick="window.open('./action/cancelcard.php?task=<?php echo $task['number']; ?>','local', 'width=400 , height=700')"
                   title="Annuler une tâche">
                    <div class="button cancel"></div>
                </a>
                <a onclick="window.open('./form/modifycardform.php?task=<?php echo $task['number']; ?>','local', 'width=400 , height=700')"
                   title="Modifier une tâche">
                    <div class="button edit"></div>
                </a>
                <a onclick="window.open('./action/startcard.php?task=<?php echo $task['number']; ?>','local', 'width=400 , height=700')"
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
                <a onclick="window.open('./form/addcardform.php?status=1','local', 'width=400 , height=700')"
                   title="Créer une tâche dans ce menu">
                    <div class="button create"></div>
                </a>
                <a onclick="window.open('./form/filtermenuform.php?kanban=started','local', 'width=400 , height=332')"
                   title="Filtrer">
                    <div class="button filter"></div>
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
                <a onclick="window.open('./action/cancelcard.php?task=<?php echo $task['number']; ?>','local', 'width=400 , height=700')"
                   title="Annuler une tâche">
                    <div class="button cancel"></div>
                </a>
                <a onclick="window.open('./form/modifycardform.php?task=<?php echo $task['number']; ?>','local', 'width=400 , height=700')"
                   title="Modifier une tâche">
                    <div class="button edit"></div>
                </a>
                <a onclick="window.open('./action/closecard.php?task=<?php echo $task['number']; ?>','local', 'width=400 , height=700')"
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
                <a onclick="window.open('./form/addcardform.php?status=2','local', 'width=400 , height=700')"
                   title="Créer une tâche dans ce menu">
                    <div class="button create"></div>
                </a>
                <a onclick="window.open('./form/filtermenuform.php?kanban=closed','local','width=400 , height=332')"
                   title="Filtrer">
                    <div class="button filter"></div>
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
                <a onclick="window.open('./view/card.php?task=<?php echo $task['number']; ?>','local', 'width=400 , height=560')"
                   title="<?php echo '#' . $task['number'] . ' - ' . $task['name']; ?>">
                    <div class="titre"><p><?php echo '#' . $task['number'] . ' - ' . $task['name']; ?></p></div>
                </a>
                <a onclick="window.open('./form/modifycardform.php?task=<?php echo $task['number']; ?>','local', 'width=400 , height=700')"
                   title="Modifier une tâche">
                    <div class="button edit"></div>
                </a>
                <a onclick="window.open('./action/restorecard.php?task=<?php echo $task['number']; ?>','local', 'width=400 , height=700')"
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
                <a onclick="window.open('./form/addcardform.php?status=3','local', 'width=400 , height=700')"
                   title="Créer une tâche dans ce menu">
                    <div class="button create"></div>
                </a>
                <a onclick="window.open('./form/filtermenuform.php?kanban=cancelled','local', 'width=400 , height=332')"
                   title="Filtrer">
                    <div class="button filter"></div>
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
                <a onclick="window.open('./view/card.php?task=<?php echo $task['number']; ?>','local', 'width=400 , height=560')"
                   title="<?php echo '#' . $task['number'] . ' - ' . $task['name']; ?>">
                    <div class="titre"><p><?php echo '#' . $task['number'] . ' - ' . $task['name']; ?></p></div>
                </a>
                <a onclick="window.open('./action/deletecard.php?task=<?php echo $task['number']; ?>','local', 'width=400 , height=700')"
                   title="Supprimer une tâche">
                    <div class="button delete"></div>
                </a>
                <a onclick="window.open('./form/modifycardform.php?task=<?php echo $task['number']; ?>','local', 'width=400 , height=700')"
                   title="Modifier une tâche">
                    <div class="button edit"></div>
                </a>
                <a onclick="window.open('./action/restorecard.php?task=<?php echo $task['number']; ?>','local', 'width=400 , height=700')"
                   title="Restaurer une tâche">
                    <div class="button restart"></div>
                </a>
            </div>
            <?php
        }
        ?>
    </fieldset>
</div>
</body>
<footer>
    <p>Tous droits réservés - Jonathan Istace - 2024</p>
</footer>
</html>