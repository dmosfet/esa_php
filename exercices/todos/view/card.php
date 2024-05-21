<!doctype html>
<html lang="fr" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../CSS/pico/pico.min.css">
    <link rel="stylesheet" href="../CSS/style.css">
    <title>Tâche</title>
</head>
<body>
<?php
include("../function.php");
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
<?php
}
$number = $_GET['task'];
$alltasks = arrayfromcsv("../tasks.csv");
$task = findtask($alltasks, $number);
?>
<form action="../form/modifycardform.php" method="post">

    <fieldset>
        <legend><?php echo '#' . $number . " - " . $task['name']; ?></legend>
        <?php
        foreach ($task as $key => $value) {
            $label = match($key) {
                'number' => 'Numéro',
                'name' => 'Nom',
                'status' => 'Statut actuel',
                'old_status' => 'Ancien statut',
                'creation' => 'Date de creation',
                'start' => 'Date de début',
                'due' => 'Echéance',
                'closed' => 'Date de clôture',
                'cancelled' => 'Date d\'annulation',
                'tags' => 'Catégories',
            };
            if ($key =="status") {
                $statut = match ($value) {
                    '0' => "Nouvelle tâche",
                    '1' => "En cours",
                    '2' => "Terminée",
                    '3' => "Annulée",
                    '-1' => "Supprimée",
                };
                $value = $statut;
            }

            if ($key == "old_status") {
                $statut = match ($value) {
                    '0' => "Nouvelle tâche",
                    '1' => "En cours",
                    '2' => "Terminée",
                    '3' => "Annulée",
                    '-1' => "Supprimée",
                };
                $value = $statut;
            }
            ?>
            <p><?php echo $label . ": " . $value;?></p>
        <?php }
        ?>
        <input type="hidden" name="number" value="<?php echo $number; ?>">
        <input type="submit" name="modify" value="Modifier">
        <input type="submit" name="close" value="Fermer" onclick="refreshAndClose()">
    </fieldset>
</form>
<script type="text/javascript">
    function refreshAndClose() {
        window.opener.location.reload(true);
        window.close();
    }
</script>
</body>
</html>

