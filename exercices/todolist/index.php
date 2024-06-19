<?php
session_start();
include('function.php');
require('view/layouts/header.php');
$mode= $_GET['mode'];
if (!isset($_SESSION['user']) && $mode != "adduser") { ?>
    <dialog open>
        <form action="./controller/session.php" method="post">
            <p>email: test@test.be</p>
            <p>mot de passe: test</p>
            <p>ou s'enregistrer</p>
            <p><?php if (isset($_GET['msg'])) {echo urldecode($_GET['msg']);}?></p>
            <label>Email</label>
            <input type="text" name="mail">
            <label>Mot de passe</label>
            <input type="password" name="password">
            <input type="submit" name="submit" value="Se connecter">
            <a href="index.php?mode=adduser"><button type="button">S'enregistrer</button></a>
        </form>
    </dialog>
    <?php
} else {

    $mode = $_GET['mode'] ?? 'main';

    switch ($mode) {
        case 'planner':
            require('./view/planner.php');
            break;
        case 'addcard':
            require('./view/form/addcardform.php');
            break;
        case 'adduser':
            require('./view/form/adduserform.php');
            break;
        case 'user':
            require('./view/usercard.php');
            break;
        case 'stat':
            require('./view/statistiques.php');
            break;
        case 'settings':
            require('./view/settings.php');
            break;
        case 'notification':
            require('./view/notification.php');
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
        case 'usermodifyer':
            require('./view/form/modifyuserform.php');
            break;
        case 'addusertask':
            require('./view/form/cardform/card_addusertask_form.php');
            break;
        default:
            require('./view/kanban.php');
            break;
    }

    require('view/layouts/footer.php');
}