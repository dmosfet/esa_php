<?php

function testPhp ($arg1, $arg2 ="toto") {

    return "test: " . $arg1 . "," . $arg2 . "\n";

}

$a = "bonjour";
$b = "tout le monde";

echo testPhp ($a, $b);
echo testPhp ($a);
//echo test ();
