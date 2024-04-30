<?php ob_start()?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="./CSS/style.css">
    <title>Document</title>
</head>
<body>
<?php
$texte = $_POST['texte'];
$listecouleurs =["black", "yellow", "red"];

if (str_word_count($texte) < 10) {
    $msg='Je ne dispose pas de 10 mots';
    header('Location: index.php?msg='.$msg);
} else {
    // On boucle sur le texte reçu caractère par caractères
    $maxcompteurlettre = strlen($texte) - 1;
    $compteurcouleur = 0;
    for ($i=0;$i<=$maxcompteurlettre;$i++) {
        if ($texte[$i] !== " ") {
            echo '<span class="'.$listecouleurs[$compteurcouleur%3].'">'.$texte[$i].'</span>';
            $compteurcouleur++;
        } else {
            echo " ";
        }
    }
}
?>

<div class ="plane">
    <!-- The image has scrolling behavior to left -->
    <marquee  behavior="scroll" direction="left">
        <img src= "./images/avion.png" alt="GeeksforGeeks logo">
    </marquee>
    <audio controls autoplay src="./ressources/hymne-national-belge.mp3"></audio>
</div>

</body>
</html>


<?php
