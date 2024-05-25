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
include("../function.php");
$deletedtask = [];
$alltasks = arrayfromcsv("../tasks.csv");
foreach ($alltasks as $task) {
    if ($task['status'] == "-1") {
        $deletedtask[] = $task;
    }
}

if ($deletedtask != null) {
    foreach ($deletedtask as $task) {
        ?>
        <div class="cartouche">
            <a onclick="window.open('./card.php?task=<?php echo $task['number']; ?>','local', 'width=400 , height=700')"
               title="<?php echo '#' . $task[0] . ' - ' . $task[1]; ?>">
                <div class="titre"><p><?php echo '#' . $task['number'] . ' - ' . $task['name']; ?></p></div>
            </a>
            <a onclick="window.open('../action/definitelydeletecard.php?task=<?php echo $task['number']; ?>','local', 'width=400 , height=700')"
               title="Supprimer définitivement une tâche">
                <div class="button delete"></div>
            </a>
            <a onclick="window.open('../action/restorecard.php?task=<?php echo $task['number']; ?>','local', 'width=400 , height=700')"
               title="Restaurer une tâche">
                <div class="button start"></div>
            </a>
        </div>
        <?php
    }
} else {
    echo "Il n'y a pas de tâche supprimée dans la poubelle actuellement";
}
?>
<form>
    <input type="submit" name="close" value="Fermer" onclick="refreshAndClose()">
</form>
<script type="text/javascript">
    function refreshAndClose() {
        window.opener.location.reload(true);
        window.close();
    }
</script>

</body>
</html>

