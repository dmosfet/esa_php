<!doctype html>
<html lang="fr" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../CSS/pico/pico.min.css">
    <link rel="stylesheet" href="../CSS/style.php">
    <title>Tâche à modifier</title>
</head>
<body>
<?php include("../function.php");
$tasknumber = isset($_POST['number']) ? $_POST['number'] : $_GET['task'];
$alltasks = arrayfromcsv("../tasks.csv");
$task = findtask($alltasks, $tasknumber);

$alltags = arrayfromcsv('../tags.csv');

$number = $task['number'];
$name = $task['name'];
$status = $task['status'];
$old_status = $task['old_status'];
$creation = $task['creation'];
$start = $task['start'];
$due = $task['due'];
$closed = $task['closed'];
$cancelled = $task['cancelled'];
$tags = $task['tags']

?>
<form action="../action/modifycard.php" method="post">
    <fieldset>
        <legend>Modifier la tâche <?php echo '#' . $tasknumber ?></legend>
        <?php include("../model/card_form_model.php"); ?>
        <fieldset>
            <input type="submit" name="submit" value="Confirmer">
            <input type="submit" name="close" value="Annuler" onclick="refreshAndClose()">
        </fieldset>
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

