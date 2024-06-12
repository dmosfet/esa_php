<?php
$new = $_COOKIE['new'] ?? 'taskid_ascsort';
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

?>
<div class="modifyfilter">
    <form action="./controller/modifyfilter.php" method="post">
        <fieldset class="card">
            <div class="filterform">
                <label>Filtre de la colonne: Backlog</label>
                <input type="text" list="filtertype" name="new" placeholder="<?php echo $new;?>" value="">
                <datalist id="filtertype">
                    <option label="Par numéro, ordre croissant" value="Par numéro, ordre croissant"></option>
                    <option label="Par numéro, ordre décroissant" value="Par numéro, ordre décroissant"></option>
                    <option label="Par nom, ordre croissant" value="Par nom, ordre croissant"></option>
                    <option label="Par nom, ordre décroissant" value="Par nom, ordre décroissant"></option>
                </datalist>
                <label>Filtre de la colonne: En cours</label>
                <input type="text" list="filtertype" name="started" placeholder="<?php echo $started;?>" value="">
                <datalist id="filtertype">
                    <option label="Par numéro, ordre croissant" value="Par numéro, ordre croissant"></option>
                    <option label="Par numéro, ordre décroissant" value="Par numéro, ordre décroissant"></option>
                    <option label="Par nom, ordre croissant" value="Par nom, ordre croissant"></option>
                    <option label="Par nom, ordre décroissant" value="Par nom, ordre décroissant"></option>
                </datalist>
                <label>Filtre de la colonne: Terminée</label>
                <input type="text" list="filtertype" name="closed" placeholder="<?php echo $closed;?>" value="">
                <datalist id="filtertype">
                    <option label="Par numéro, ordre croissant" value="Par numéro, ordre croissant"></option>
                    <option label="Par numéro, ordre décroissant" value="Par numéro, ordre décroissant"></option>
                    <option label="Par nom, ordre croissant" value="Par nom, ordre croissant"></option>
                    <option label="Par nom, ordre décroissant" value="Par nom, ordre décroissant"></option>
                </datalist>
                <label>Filtre de la colonne: Annulée</label>
                <input type="text" list="filtertype" name="cancelled" placeholder="<?php echo $cancelled;?>" value="">
                <datalist id="filtertype">
                    <option label="Par numéro, ordre croissant" value="Par numéro, ordre croissant"></option>
                    <option label="Par numéro, ordre décroissant" value="Par numéro, ordre décroissant"></option>
                    <option label="Par nom, ordre croissant" value="Par nom, ordre croissant"></option>
                    <option label="Par nom, ordre décroissant" value="Par nom, ordre décroissant"></option>
                </datalist>
                <input type="submit" value="Filtrer">
            </div>
        </fieldset>
    </form>
</div>
