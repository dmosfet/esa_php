<!doctype html>
<html lang="fr" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./CSS/pico/pico.min.css">
    <link rel="stylesheet" href="./CSS/style.php">
    <title>Tâche</title>
</head>
<body>
<?php
include("function.php");
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
$alltags = arrayfromcsv('tags.csv');
$colortheme = arrayfromcsv('colortheme.csv');

if ($_GET['mode']=="view") {
    include('./view/colors.php');
} else {
    include('./form/modifycolorform.php');
}

?>
</body>
</html>

