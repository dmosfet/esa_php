<?php ob_start()?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8 (Without BOM)">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<?php
$texte = $_POST['texte'];

if (str_word_count($texte) < 10) {
    $msg='Je ne dispose pas de 10 mots';
    header('Location: index.php?msg='.$msg);
} else {
    // On boucle sur le texte reçu caractère par caractères
    $maxcompteurlettre = strlen($texte)-1;
    $compteurcouleur = 0;
    for ($i = 0; $i <= $maxcompteurlettre; $i++) {
        if ($texte[$i] !== ' ') {
            match ($compteurcouleur % 3) {
                0 => noir($texte[$i]),
                1 => jaune($texte[$i]),
                2 => rouge($texte[$i]),
            };
            $compteurcouleur ++;
        } else {
            echo " ";
        }
    }
}
function noir ($lettre) {
    echo '<span style="color:black">'.$lettre.'</span>';
}

function jaune ($lettre) {
    echo '<span style="color:yellow">'.$lettre.'</span>';
}
function rouge ($lettre) {
    echo '<span style="color:red">'.$lettre.'</span>';
}


?>
</body>
</html>


<?php
