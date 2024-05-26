<!doctype html>
<html lang="fr" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
    <link rel="stylesheet" href="../CSS/style.php">
    <title>Tâche</title>
</head>
<body>
<?php
if (isset($_GET['msg'])) {
    $message = $_GET['msg'];
    ?>
    <dialog open>
        <form method="dialog">
            <div class="dialog">
                <label><?php echo $message ?></label>
                <button>OK</button>
            </div>
        </form>
    </dialog>
<?php }
$kanban = isset($_GET['kanban']) ? $_GET['kanban'] : 'new';

$nomkanban = match ($kanban) {
    'new' => "Backlog",
    'started' => "En cours",
    'closed' => "Terminé",
    'cancelled' => 'Annulé',
}

?>
<div class="modifyfilter">
    <form action="<?php echo "../action/modifyfilter.php?kanban=" . $kanban; ?>" method="post">
        <fieldset class="card">
            <div class="filterform">
                <label>Filtre de la colonne: <?php echo $nomkanban; ?></label>
                <input type="hidden" name="kanban" value="<?php echo $kanban; ?>">
                <input type="text" list="filtertype" name="filter" placeholder="Ordre croissant" value="">
                <datalist id="filtertype">
                    <option label="Par numéro, ordre croissant" value="taskid_ascsort"></option>
                    <option label="Par numéro, ordre décroissant" value="taskid_descsort"></option>
                    <option label="Par nom, ordre croissant" value="taskname_ascsort"></option>
                    <option label="Par nom, ordre décroissant" value="taskname_descsort"></option>
                </datalist>
                <input type="submit" value="Filtrer">
                <input type="submit" name="close" value="Annuler" onclick="refreshAndClose()">
            </div>
        </fieldset>
    </form>
</div>
<script type="text/javascript">
    function refreshAndClose() {
        window.opener.location.reload(true);
        window.close();
    }
</script>

</body>
</html>