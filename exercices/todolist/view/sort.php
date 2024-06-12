<?php
$new= $_COOKIE['new'] ?? 'taskid_ascsort';
$started = $_COOKIE['started'] ?? 'taskid_ascsort';
$closed = $_COOKIE['closed'] ?? 'taskid_ascsort';
$cancelled = $_COOKIE['cancelled'] ?? 'taskid_ascsort';

$new = match ($new) {
    'taskid_ascsort' => "Par numéro, ordre croissant",
    'taskid_descsort' => "Par numéro, ordre décroissant",
    'taskname_ascsort' => "Par nom, ordre croissant",
    'taskname_descsort' => 'Par nom, ordre décroissant',
};

$started = match ($started) {
    'taskid_ascsort' => "Par numéro, ordre croissant",
    'taskid_descsort' => "Par numéro, ordre décroissant",
    'taskname_ascsort' => "Par nom, ordre croissant",
    'taskname_descsort' => 'Par nom, ordre décroissant',
};

$closed = match ($closed) {
    'taskid_ascsort' => "Par numéro, ordre croissant",
    'taskid_descsort' => "Par numéro, ordre décroissant",
    'taskname_ascsort' => "Par nom, ordre croissant",
    'taskname_descsort' => 'Par nom, ordre décroissant',
};
$cancelled = match ($cancelled) {
    'taskid_ascsort' => "Par numéro, ordre croissant",
    'taskid_descsort' => "Par numéro, ordre décroissant",
    'taskname_ascsort' => "Par nom, ordre croissant",
    'taskname_descsort' => 'Par nom, ordre décroissant',
};

if ($_GET['view'] == "modifyfilter") {
    include('./view/form/filtermenuform.php');
} else { ?>
    <div class="viewsort">
        <fieldset class="card">
            <legend class="legendkanban"><span class="button sort"></span>Tri</legend>
            <div class="sorttable">
                <table>
                    <thead>
                    <tr>
                        <th scope="col">Kanban</th>
                        <th scope="col">Type de tri</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th>Backlog</th>
                        <td><?php echo $new ?></td>
                    </tr>
                    <tr>
                        <th>En cours</th>
                        <td><?php echo $started ?></td>
                    </tr>
                    <tr>
                        <th>Terminées</th>
                        <td><?php echo $closed ?></td>
                    </tr>
                    <tr>
                        <th>Annulées</th>
                        <td><?php echo $cancelled ?></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="tagform">
                <form method="get">
                    <input type="hidden" name="mode" value="settings">
                    <input type="hidden" name= "view" value="modifyfilter">
                    <input type="submit" name="submit" value="Modifier">
                </form>
            </div>
        </fieldset>
    </div>
<?php } ?>

