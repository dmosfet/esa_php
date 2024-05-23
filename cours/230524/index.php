<?php ob_start();

if (isset($_COOKIE['nbrvisite'])) {
    echo "C'est votre " . ($_COOKIE['nbrvisite']+1) . "ème visite";
    setcookie("nbrvisite", ($_COOKIE['nbrvisite']+1));
} else {
    echo "C'est votre première visite !";
    setcookie("nbrvisite", 1);
}
