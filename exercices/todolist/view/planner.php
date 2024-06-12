<?php

$alltasks = arrayfromcsv('./model/tasks.csv');
$annee = isset($_GET["year"]) ? $_GET["year"] : date('Y');
$sem = isset($_GET["sem"]) ? $_GET["sem"] : date('W');
$date = date_create();
?>
<div class="viewplanning">
    <fieldset class="card">
        <legend>Planning</legend>
        <div class="planning">
            <table>
                <thead>
                <tr>
                    <th colspan="8">
                        Semaine <?php echo $sem; ?>
                        <a href="index.php?mode=planner&year=<?php
                        if ($sem == "52") {
                            echo $annee+1 . "&sem=1";
                        } else {
                            echo $annee . "&sem=" . $sem+1;
                        }
                        ?>">
                            <div class="button weekafter"></div>
                        </a>
                        <a href="index.php?mode=planner&year=<?php
                        if ($sem == "1") {
                            echo $annee-1 . "&sem=52";
                        } else {
                            echo $annee . "&sem=" . $sem-1;
                        }?> ">
                            <div class="button weekbefore"></div>
                        </a>
                    </th>
                </tr>
                <tr>
                    <th class="taskcolumn" rowspan="8">Nom de la tâche</th>
                    <?php for ($i = 1; $i <= 7; $i++) {
                        date_isodate_set($date, $annee, $sem, $i);
                        ?>
                        <th class="datecolumn"><?php
                            $mois= match (date_format($date, "M")) {
                                'Jan' => 'Jan',
                                'Feb' => 'Fev',
                                'Mar' => 'Mars',
                                'Apr' => 'Avr',
                                'May' => 'Mai',
                                'Jun' => 'Juin',
                                'Jul' => 'Juil',
                                'Aug' => 'Aout',
                                'Sep' => 'Sept',
                                'Oct' => 'Oct',
                                'Nov' => 'Nov',
                                'Dec' => 'Dec',
                            };
                            echo date_format($date, "d") . " " . $mois ?></th>
                        <?php
                    }
                    ?>
                </tr>
                <tr>
                    <?php for ($i = 1; $i <= 7; $i++) {
                        date_isodate_set($date, $annee, $sem, $i);
                        $jour= match (date_format($date, "D")) {
                            'Mon' => 'Lun',
                            'Tue' => 'Mar',
                            'Wed' => 'Mer',
                            'Thu' => 'Jeu',
                            'Fri' => 'Ven',
                            'Sat' => 'Sam',
                            'Sun' => 'Dim',
                        };
                        ?>
                        <th><?php echo $jour; ?></th>
                        <?php
                    }
                    ?>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($alltasks

                         as $task) {
                    ?>
                    <tr>
                        <td><?php echo $task['name']; ?></td>

                        <?php
                        for ($i = 1; $i <= 7; $i++) {
                            date_isodate_set($date, $annee, $sem, $i);
                            ?>
                            <td class="
                    <?php
                            echo checkdateforplanning(strtotime(date_format($date, 'Y-m-d')), (int)$task['start'], (int)$task['due'], (int)$task['closed'], (int)$task['cancelled']);
                            ?>"></td>
                            <?php
                        }
                        ?>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
        </div>
    </fieldset>
</div>
<div class="legendplanning">
    <fieldset class="card">
        <legend>Legend</legend>
        <div class="planning">
            <table>
                <tr>
                    <th>Couleur</th>
                    <th>Signification</th>
                </tr>
                <tr>
                    <th class="T"></th>
                    <th>Jours utilisés pour réaliser une tâche terminées</th>
                </tr>
                <tr>
                    <th class="P"></th>
                    <th>Jours planifiés pour réaliser une tâche démarrée</th>
                </tr>
                <tr>
                    <th class="B"></th>
                    <th>Jours non-utilisés pour réaliser une tâche terminée</th>
                </tr>
                <tr>
                    <th class="M"></th>
                    <th>Jours dépassement pour réaliser une tâche</th>
                </tr>
                <tr>
                    <th class="L"></th>
                    <th>Jours planifiés pour une tâche abandonnée</th>
                </tr>
                <tr>
                    <th class="W"></th>
                    <th>Jours utilisés pour une tâche abandonnée</th>
                </tr>
            </table>
        </div>
    </fieldset>
</div>
