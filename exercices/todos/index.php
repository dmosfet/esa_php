<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="CSS/pico/pico.min.css">
    <link rel="stylesheet" href="CSS/style.css">
    <title>Gestionnaire de tâches</title>
</head>
<header>
    <h2>Planificateur de tâches
        <a onclick="window.open('./view/recycle.php','local', 'width=400 , height=800')" title="Consulter les tâches supprimées">
            <div class="bin"></div>
        </a>
        <a onclick="window.open('./view/settings.php','local', 'width=800 , height=900')" title="Consulter les paramètres de l'application">
            <div class="settings"></div>
        </a>
    </h2>
</header>
<body>
<?php
include('function.php');
?>
<div class="kanban">
    <fieldset class="nouveau">
        <legend>Back log
            <div class="action">
                <a onclick="window.open('./form/searchcardform.php','local', 'width=400 , height=200')"
                   title="Rechercher une tâche">
                    <div class="button search"></div>
                </a>
                <a onclick="window.open('./form/addcardform.php?status=0','local', 'width=400 , height=700')"
                   title="Ajouter une tâche">
                    <div class="button create"></div>
                </a>
                <a onclick="window.open('.index.php?filternew=all','local', 'width=400 , height=700')" title="Filtrer">
                    <div class="button filter"></div>
                </a>
            </div>
        </legend>
        <?php
        $newtasks = filtertaskonstatus("tasks.csv", "0");
        foreach ($newtasks as $task) {
            ?>
            <div class="cartouche">
                <a onclick="window.open('./view/card.php?task=<?php echo $task[0]; ?>','local', 'width=200 , min-height=300')"
                   title="<?php echo '#' . $task[0] . ' - ' . $task[1]; ?>">
                    <div class="titre"><p><?php echo '#' . $task[0] . ' - ' . $task[1]; ?></p></div>
                </a>
                <a onclick="window.open('./action/cancelcard.php?task=<?php echo $task[0]; ?>','local', 'width=400 , height=700')"
                   title="Annuler une tâche">
                    <div class="button cancel"></div>
                </a>
                <a onclick="window.open('./form/modifycardform.php?task=<?php echo $task[0]; ?>','local', 'width=400 , height=700')"
                   title="Modifier une tâche">
                    <div class="button edit"></div>
                </a>
                <a onclick="window.open('./action/startcard.php?task=<?php echo $task[0]; ?>','local', 'width=400 , height=700')"
                   title="Démarrer une tâche">
                    <div class="button start"></div>
                </a>
            </div>
            <?php
        }
        ?>
    </fieldset>
    <fieldset class="cours">
        <legend>En cours
            <div class="action">
                <a onclick="window.open('./form/searchcardform.php','local', 'width=400 , height=200')">
                    <div class="button search"></div>
                </a>
                <a onclick="window.open('./form/addcardform.php?status=1','local', 'width=400 , height=700')">
                    <div class="button create"></div>
                </a>
                <a onclick="window.open('.index.php?filterstart=all','local', 'width=400 , height=700')" title="Filtrer">
                    <div class="button filter"></div>
                </a>
            </div>
        </legend>
        <?php
        $openedtasks = filtertaskonstatus("tasks.csv", "1");
        foreach ($openedtasks as $task) {
            ?>
            <div class="cartouche">
                <a onclick="window.open('./view/card.php?task=<?php echo $task[0]; ?>','local', 'width=400 , height=560')"
                   title="<?php echo '#' . $task[0] . ' - ' . $task[1]; ?>">
                    <div class="titre"><p><?php echo '#' . $task[0] . ' - ' . $task[1]; ?></p></div>
                </a>
                <a onclick="window.open('./action/cancelcard.php?task=<?php echo $task[0]; ?>','local', 'width=400 , height=700')"
                   title="Annuler une tâche">
                    <div class="button cancel"></div>
                </a>
                <a onclick="window.open('./form/modifycardform.php?task=<?php echo $task[0]; ?>','local', 'width=400 , height=700')"
                   title="Modifier une tâche">
                    <div class="button edit"></div>
                </a>
                <a onclick="window.open('./action/closecard.php?task=<?php echo $task[0]; ?>','local', 'width=400 , height=700')"
                   title="Terminer une tâche">
                    <div class="button close"></div>
                </a>

            </div>
            <?php
        }
        ?>
    </fieldset>
    <fieldset class="terminé">
        <legend>Terminé
            <div class="action">
                <a onclick="window.open('./form/searchcardform.php','local', 'width=400 , height=200')">
                    <div class="button search"></div>
                </a>
                <a onclick="window.open('./form/addcardform.php?status=2','local', 'width=400 , height=700')">
                    <div class="button create"></div>
                </a>
                <a onclick="window.open('.index.php?filterclose=all','local', 'width=400 , height=700')" title="Filtrer">
                    <div class="button filter"></div>
                </a>
            </div>
        </legend>
        <?php
        $closedtasks = filtertaskonstatus("tasks.csv", "2");
        foreach ($closedtasks as $task) { ?>
            <div class="cartouche">
                <a onclick="window.open('./view/card.php?task=<?php echo $task[0]; ?>','local', 'width=400 , height=560')"
                   title="<?php echo '#' . $task[0] . ' - ' . $task[1]; ?>">
                    <div class="titre"><p><?php echo '#' . $task[0] . ' - ' . $task[1]; ?></p></div>
                </a>
                <a onclick="window.open('./form/modifycardform.php?task=<?php echo $task[0]; ?>','local', 'width=400 , height=700')"
                   title="Modifier une tâche">
                    <div class="button edit"></div>
                </a>
                <a onclick="window.open('./action/restorecard.php?task=<?php echo $task[0]; ?>','local', 'width=400 , height=700')"
                   title="Restaurer une tâche">
                    <div class="button start"></div>
                </a>
            </div>
            <?php
        }
        ?>
    </fieldset>
    <fieldset class="annulé">
        <legend>Annulé
            <div class="action">
                <a onclick="window.open('./form/searchcardform.php','local', 'width=400 , height=200')">
                    <div class="button search"></div>
                </a>
                <a onclick="window.open('./form/addcardform.php?status=3','local', 'width=400 , height=700')">
                    <div class="button create"></div>
                </a>
                <a onclick="window.open('.index.php?filtercancel=all','local', 'width=400 , height=700')" title="Filtrer">
                    <div class="button filter"></div>
                </a>
            </div>
        </legend>
        <?php
        $droppedtasks = filtertaskonstatus("tasks.csv", "3");
        foreach ($droppedtasks as $task) { ?>
            <div class="cartouche">
                <a onclick="window.open('./view/card.php?task=<?php echo $task[0]; ?>','local', 'width=400 , height=560')"
                   title="<?php echo '#' . $task[0] . ' - ' . $task[1]; ?>">
                    <div class="titre"><p><?php echo '#' . $task[0] . ' - ' . $task[1]; ?></p></div>
                </a>
                <a onclick="window.open('./action/deletecard.php?task=<?php echo $task[0]; ?>','local', 'width=400 , height=700')"
                   title="Supprimer une tâche">
                    <div class="button delete"></div>
                </a>
                <a onclick="window.open('./form/modifycardform.php?task=<?php echo $task[0]; ?>','local', 'width=400 , height=700')"
                   title="Modifier une tâche">
                    <div class="button edit"></div>
                </a>
                <a onclick="window.open('./action/restorecard.php?task=<?php echo $task[0]; ?>','local', 'width=400 , height=700')"
                   title="Restaurer une tâche">
                    <div class="button start"></div>
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