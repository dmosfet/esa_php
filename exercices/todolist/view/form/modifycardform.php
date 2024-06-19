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

$tasknumber = $_GET['task'] ?? $_SESSION['task'];
$alltasks = arrayfromcsv("./model/tasks.csv");
$user = findtask($alltasks, $tasknumber);

$alltags = arrayfromcsv('./model/tags.csv');

$number = $user['number'];
$name = $user['name'];
$description = $user['description'];
$status = $user['status'];
$old_status = $user['old_status'];
$creation = !empty($user['creation']) ? date('d-m-Y', $user['creation']) : "";
$start = !empty($user['start']) ? date('d-m-Y', $user['start']) : "";
$due = !empty($user['due']) ? date('d-m-Y', $user['due']) : "";
$closed = !empty($user['closed']) ? date('d-m-Y', $user['closed']) : "";
$cancelled = !empty($user['cancelled']) ? date('d-m-Y', $user['cancelled']) : "";
$tags = $user['tags']

?>
<div class="addform">
    <form action="./controller/modifycard.php" method="post">
        <fieldset class="card">
            <legend>Modifier la tâche <?php echo '#' . $tasknumber ?></legend>
            <div class="formview">
                <?php include("card_form_model.php"); ?>
                <fieldset>
                    <input type="submit" name="submit" value="Confirmer">
                </fieldset>
            </div>
        </fieldset>
    </form>
    <form action="index.php" method="get">
        <fieldset class="card">
            <input type="submit" name="mode" value="Annuler">
        </fieldset>
    </form>
</div>
