<?php
/*$a = "3";
$b = 3;
echo "$a == $b : " . ($a == $b) . "<br>";
echo "$a == $b : " . ($a === $b) . "<br>";
echo "$a === $b : " . ((int) $a === $b) . "<br>";
echo "$a === $b : " . (int)($a === $b) . "<br>";

var_dump($a==$b);
echo "<br>";
var_dump($a===$b);
echo "<br>";
var_dump((int)$a===$b);
echo "<br>";


$a = 3;
$b = 5;
$c = 9;

$comparaison =  ( ($a < $b) && ($a < $c) ); // vrai
$comparaison2 =  ( ($a < $b) XOR ($a < $c) ); // vrai

echo "( ($a < $b) && ($a < $c) ) : " . (int)($comparaison) . "<br>";
echo "( ($a < $b) XOR ($a < $c) ) : " . (int)($comparaison2) . "<br>";


$age = 35;

if ($age < 30) {
    echo "Vous êtes jeunes !!! <br>";
} else {
    echo "Vous êtes moins jeunes !!! <br>";
}

$message  = "Vous êtes majeur";
if ($age < 18) {
    $message = "Vous êtes mineur";
}
echo $message;

$age = 23;

$result = match (true) {
    $age >= 65 => 'senior',
    $age >= 25 => 'adult',
    $age >= 18 => 'young adult',
    default => 'kid',
};

echo ($result);

$mystere = mt_rand(0,4);

switch($mystere) {
    case 4 :
        echo "$mystere est supérieur à 3 <br>";
        break;
    case 3 :
        echo "$mystere est supérieur à 2 <br>";
        break;
    case 2 :
        echo "$mystere est supérieur à 1<br>";
        break;
    case 1 :
        echo "$mystere est supérieur à 0 <br>";
        break;
    default :
        echo "$mystere est 0 <br>";
}



$i = 0;
while ($i <= 10) {
    echo $i . "<br>";
    $i++;
}

echo "<br>";
$j = 0;
do {
    echo $j . "<br>";
    $j++;
} while ($j < 0);

echo "<br>";
*/

$nombre = (int)readline("Quelle table de multiplication veux-tu ? : ");
//var_dump($nombre);

if ($nombre == 0) {
    echo "Ceci n'est pas un chiffre valable";
    return false;
}

$i= 0;
while ($i < 10) {
    echo ++$i . " x $nombre = " . $i * $nombre . "\n";
}

echo "\n";

for ($i=1;$i<=10;$i++) {
    echo $i . " x $nombre = " . $i * $nombre . "\n";
}


?>
