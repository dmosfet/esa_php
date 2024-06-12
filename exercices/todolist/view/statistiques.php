<?php
$alltasks = arrayfromcsv('./model/tasks.csv');
$newtasks = statusfilteredarray($alltasks, "0");
$startedtasks = statusfilteredarray($alltasks, "1");
$closedtasks = statusfilteredarray($alltasks, "2");
$cancelledtasks = statusfilteredarray($alltasks, "3");

$nbrnewtasks = count($newtasks);
$nbrstartedtasks = count($startedtasks);
$nbrclosedtasks = count($closedtasks);
$nbrcancelledtasks = count($cancelledtasks);
$nbrtasks = count($alltasks);

$delais = [];
$maxdelai = 0;
$delaimoyen = 0;
$total = 0;

foreach ($closedtasks as $task) {
    $delai = ($task['closed'] - $task['start']);
    $total += $task['closed'] - $task['start'];
    $delais[] = $delai;
}

if ($nbrclosedtasks > 0) {
    $maxdelai = max($delais) / 60 / 60 / 24;;
    $delaimoyen = $total / $nbrclosedtasks / 60 / 60 / 24;
}

?>
<div class="viewstat">
    <fieldset class="card">
        <legend class="legendkanban"><span class="button chart"></span>Statistiques</legend>
        <div class="stattable">
            <table>
                <caption>
                    Par type
                </caption>
                <thead>
                <tr>
                    <th scope="col">Tâches</th>
                    <th scope="col">Total</th>
                    <th scope="col">%</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>Nouvelles</td>
                    <td><?php echo $nbrnewtasks; ?></td>
                    <td><?php echo round($nbrnewtasks / $nbrtasks * 100,2) . " %"; ?></td>
                </tr>
                <tr>
                    <td>En cours</td>
                    <td><?php echo $nbrstartedtasks; ?></td>
                    <td><?php echo round($nbrstartedtasks / $nbrtasks * 100,2) . " %"; ?></td>
                </tr>
                <tr>
                    <td>Terminée</td>
                    <td><?php echo $nbrclosedtasks; ?></td>
                    <td><?php echo round($nbrclosedtasks / $nbrtasks * 100,2) . " %"; ?></td>
                </tr>
                <tr>
                    <td>Abandonnée</td>
                    <td><?php echo $nbrcancelledtasks; ?></td>
                    <td><?php echo round($nbrcancelledtasks / $nbrtasks * 100,2) . " %"; ?></td>
                </tr>
                <tr>
                    <td>Total</td>
                    <td><?php echo $nbrtasks; ?></td>
                    <td><?php echo round($nbrtasks / $nbrtasks * 100,2) . " %"; ?></td>
                </tr>

                </tbody>
            </table>

            <table>
                <caption>
                    Délai
                </caption>
                <thead>
                <tr>
                    <th scope="col">Nom</th>
                    <th scope="col">Valeur</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>Délai moyen de cloture</td>
                    <td><?php echo $delaimoyen; ?></td>
                </tr>
                <tr>
                    <td>Delai max de cloture</td>
                    <td><?php echo $maxdelai; ?></td>
                </tr>
                </tbody>
            </table>
        </div>
    </fieldset>
</div>