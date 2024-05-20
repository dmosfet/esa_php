<!doctype html>
<html lang="fr" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../CSS/pico/pico.min.css">
    <title>Tâche</title>
</head>
<body>
<?php
include("../function.php");
if (isset($_GET['msg'])) {
    $message = $_GET['msg'];
    ?>
    <dialog open>
        <p><?php echo $message ?></p>
        <form method="dialog">
            <button>OK</button>
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
            ?>
            <p><?php echo $key . ": " .$value;?></p>
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

