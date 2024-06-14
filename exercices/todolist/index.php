<?php
session_start();
include('function.php');

require('view/layouts/header.php');

$mode = $_GET['mode'] ?? 'main';

switch ($mode) {
    case 'planner':
        require('./view/planner.php');
        break;
    case 'addcard':
        require('./view/form/addcardform.php');
        break;
    case 'stat':
        require('./view/statistiques.php');
        break;
    case 'settings':
        require('./view/settings.php');
        break;
    case 'colors':
        require('./view/colors.php');
        break;
    case 'modifycolor':
        require('./view/form/modifycolorform.php');
        break;
    case 'find':
        require('./view/search.php');
        break;
    case 'cardviewer':
        require('./view/card.php');
        break;
    case 'cardmodifyer':
        require('./view/form/modifycardform.php');
        break;
    default:
        require('./view/main.php');
        break;
}

require('view/layouts/footer.php');