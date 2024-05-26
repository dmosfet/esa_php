<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
    <link rel="stylesheet" href="../CSS/style.php">
    <title>Ajouter une nouvelle tâche</title>
</head>
<body>
<div class="searchcard">
    <form action="../action/searchcard.php" method="post">
        <fieldset class="card">
            <legend> Rechercher une tâche </legend>
            <div class="searchform">
                <label>Nom de la tâche contient</label>
                <input type="text" name="name"/>
                <input type="submit" name="submit" value="Rechercher">
            </div>
        </fieldset>
    </form>
</div>
</body>
</html>
