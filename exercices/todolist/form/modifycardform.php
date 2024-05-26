<!doctype html>
<html lang="fr" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
    <link rel="stylesheet" href="../CSS/style.php">
    <title>Tâche à modifier</title>
</head>
<body>
<?php
if (isset($_GET['msg'])) {
$message = $_GET['msg'];
?>
<dialog open>
    <form method="dialog">
        <div class="dialog">
            <label>
                <p>Listes des erreurs</p>
                <?php
                $errors=explode(',', $message);
                foreach ($errors as $error) {
                    echo $error . "<br>";
                }
                ?>
            </label>
            <button>OK</button>
        </div>
    </form>
</dialog>
<?php
}
include("../function.php");
$tasknumber = isset($_POST['number']) ? $_POST['number'] : $_GET['task'];
$alltasks = arrayfromcsv("../tasks.csv");
$task = findtask($alltasks, $tasknumber);

$alltags = arrayfromcsv('../tags.csv');

$number = $task['number'];
$name = $task['name'];
$description = $task['description'];
$status = $task['status'];
$old_status = $task['old_status'];
$creation = !empty($task['creation']) ? date('d-m-Y', $task['creation']) : "";
$start = !empty($task['start']) ? date('d-m-Y', $task['start']) : "";
$due = !empty($task['due']) ? date('d-m-Y', $task['due']) : "";
$closed = !empty($task['closed']) ? date('d-m-Y', $task['closed']) : "";
$cancelled = !empty($task['cancelled']) ? date('d-m-Y', $task['cancelled']) : "";
$tags = $task['tags']

?>
<div class="addform">
    <form action="../action/modifycard.php" method="post">
        <fieldset class="card">
            <legend>Modifier la tâche <?php echo '#' . $tasknumber ?></legend>
            <div class="formview">
                <?php include("../model/card_form_model.php"); ?>
                <fieldset>
                    <input type="submit" name="submit" value="Confirmer">
                    <input type="submit" name="close" value="Annuler" onclick="refreshAndClose()">
                </fieldset>
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