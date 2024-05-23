<?php ob_start()?>
<!doctype html>
<html lang="fr" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../CSS/pico/pico.min.css">
    <link rel="stylesheet" href="../CSS/style.php">
    <title>Tâche</title>
</head>
<body>
<?php
include("../function.php");

// On récupère les données du formulaire
$filter= $_POST['filter'];
$kanban= $_POST['kanban'];
setcookie($kanban, $filter, time() + (86400 * 30), "/");
?>

<input type="submit" name="close" value="Fermer" onclick="refreshAndClose()">
<script type="text/javascript">
    function refreshAndClose() {
        window.opener.location.reload(true);
        window.close();
    }
</script>
</body>
</html>

