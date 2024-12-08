<?php
require_once 'Db.php';

echo '<pre>';
var_dump($_GET);
echo '</pre>';

if ((!empty($_GET['id'])) && ($_GET['id'] > 0)) {

    $db = new Db();
    $db->delete($_GET['id']);

    header('Location: index.php?msg=' .urlencode("Enregistrement supprimé avec succes"));
    exit;
}
header('Location: index.php?msg=' .urlencode("Enregistrement non supprimé"));
