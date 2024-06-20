<?php
/**
 * @author: Jonathan Istace <jonathan.istace@proximus.be>
 * @description: Cette application web dans l'esprit d'un kanban permet de gérer vos différentes tâches.
 * Plusieurs utilisateurs peuvent créer un profil et s'attribuer des tâches.
 */

session_start();
include('function.php');

// On ajoute le header
require('view/layouts/header.php');

// On affiche une dialog box qui permet à l'utilisateur de se connecter. Une fois connecté, il pourra voir le contenu du site.
$mode = $_GET['mode'];
$msg = $_GET['msg'];
if (!isset($_SESSION['user']) && $mode != "adduser") { ?>
    <dialog open>
        <form action="./controller/session.php" method="post">
            <p>email: test@test.be</p>
            <p>mot de passe: test</p>
            <p>ou s'enregistrer</p>
            <label>Email</label>
            <input type="text" name="mail">
            <label>Mot de passe</label>
            <input type="password" name="password">
            <b><?php if (isset($_GET['msg'])) {echo urldecode($_GET['msg']);}?></b>
            <input type="submit" name="submit" value="Se connecter">
            <a href="index.php?mode=adduser"><button type="button">S'enregistrer</button></a>
        </form>
    </dialog>
    <?php
} else {

    // En fonction de la valeur récupérée on insère la bonne page dans l'index.php.
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
    // On ajoute le footer
    require('view/layouts/footer.php');
}