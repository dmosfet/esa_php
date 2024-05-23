<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../CSS/pico/pico.min.css">
    <link rel="stylesheet" href="../CSS/style.php">
    <title>Ajouter une nouvelle tâche</title>
</head>
<body>
<div>
    <form action="../action/searchcard.php" method="post">
        <fieldset>
            <legend>Recherche une tâche sur base de son nom</legend>
            <label>Nom de la tâche</label>
            <input type="text" name="name"/>
            <input type="submit" name="submit" value="Rechercher">
        </fieldset>
    </form>
</div>
</body>
</html>
