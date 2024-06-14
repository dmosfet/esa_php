<?php
$alltasks = arrayfromcsv('./model/tasks.csv');
$deletedtasks = statusfilteredarray($alltasks, "-1");
$recyclenumber = count($deletedtasks);
?>

<h2>Planificateur de tâches
    <a href="index.php?recycle=true"
       title="Consulter les tâches supprimées">
        <div class="bin">
            <?php
            if ($recyclenumber > 0) { ?>
                <p class="recyclenumber"><?php echo $recyclenumber;?></p>
            <?php } ?>
        </div>

    </a>
    <a href="index.php?mode=settings"
       title="Paramètres du site">
        <div class="settings"></div>
    </a>
    <a href="index.php?search=true"
       title="Rechercher une tâche">
        <div class="search"></div>
    </a>
    <a href="index.php?mode=stat"
       title="Consulter les statistiques">
        <div class="chart"></div>
    </a>
    <a href="index.php?mode=planner&year=<?php echo $year = date('Y') . "&sem=" . $week = date('W') ?>"
       title="Consulter le planning hebdomadaire">
        <div class="gantt"></div>
    </a>
    <a href="index.php"
       title="Consulter les tâches">
        <div class="main"></div>
    </a>
</h2>
<div>
    <?php
    if ($_GET['search'] == "true") {
        if ($_GET['tasks']) {
            require('./view/searchcard.php?tasks=' . $_GET['tasks']);
        } else {
            require('./view/form/searchcardform.php');
        }
    }
    ?>
</div>
<div>
    <?php
    if ($_GET['recycle'] == "true") {
        require('./view/recycle.php');
    }
    ?>
</div>