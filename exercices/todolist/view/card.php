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
$alltags = arrayfromcsv("../tags.csv");

$task = findtask($alltasks, $number);

foreach ($task as $key => $value) {
    $label = match ($key) {
        'number' => 'Numéro',
        'name' => 'Nom',
        'description' => 'Description',
        'status' => 'Statut actuel',
        'old_status' => 'Ancien statut',
        'creation' => 'Date de creation',
        'start' => 'Date de début',
        'due' => 'Echéance',
        'closed' => 'Date de clôture',
        'cancelled' => 'Date d\'annulation',
        'tags' => 'Catégories',
    };
}

$statut = match ($task['status']) {
    '0' => "Nouvelle tâche",
    '1' => "En cours",
    '2' => "Terminée",
    '3' => "Annulée",
    '-1' => "Supprimée",
};

$statusicon = match ($task['status']) {
    '0' => "s_new",
    '1' => "s_started",
    '2' => "s_closed",
    '3' => "s_cancelled",
    '-1' => "s_deleted",
};

$oldstatut = match ($task['old_status']) {
    '0' => "Nouvelle tâche",
    '1' => "En cours",
    '2' => "Terminée",
    '3' => "Annulée",
    '-1' => "Supprimée",
};

?>
<fieldset class="card">
    <div class="cardview">
            <div class="cardheader">
                <h2>
                    <span><?php echo '#' . $task['number'] . " - " . $task['name']; ?></span>
                    <div class="button <?php echo $statusicon; ?>"></div>
                </h2>
                <p><?php echo "Date de création: " . $task['creation']; ?></p>
            </div>
            <hr>
            <div class="cardtags">
                <p>Catégories: </p>
                <?php
                if ((isset($task['tags']))) {
                    $tags = explode(",", $task['tags']);
                    foreach ($tags as $tag) {
                        ?>
                        <span class="tag <?php echo $tag; ?>"><?php echo $tag; ?></span>
                        <?php
                    }
                }
                ?>
            </div>
            <hr>
            <div>
                <p>Description: </p>
                <div class="carddescription">
                    <p><?php echo $task['description']; ?></p>
                </div>
            </div>
            <hr>
            <div class="cardfiles">
                <span>Pièces jointes: </span>
                <?php
                if (isset($_GET['join']) && $_GET['join'] == "true"){
                    include('../model/card_joinfile_form.php');
                } ?>
                <a href="card.php?task=<?php echo $number;?>&join=<?php echo "true";?>"><div class="button joinfile"></div></a>

                <?php
                $piecesjointes = findcardfiles('../files.csv', $number);
                if ($piecesjointes) {
                    foreach ($piecesjointes as $fichier){
                        ?>
                <p><a href="../upload/<?php echo $fichier[1];?>"><?php echo $fichier[1];?></a></p>
                <?php
                    }
                }
                ?>
            </div>
            <hr>
            <div>
                <p>Commentaires: </p>
                <div class="cardcomments">
                    <p>Aucun commentaires</p>
                </div>
            </div>
            <p></p>
        <form action="../form/modifycardform.php" method="post">
            <input type="hidden" name="number" value="<?php echo $number; ?>">
            <input type="submit" name="modify" value="Modifier">
            <input type="submit" name="close" value="Fermer" onclick="refreshAndClose()">
        </form>
    </div>
</fieldset>

<script type="text/javascript">
    function refreshAndClose() {
        window.opener.location.reload(true);
        window.close();
    }
</script>
</body>
</html>

