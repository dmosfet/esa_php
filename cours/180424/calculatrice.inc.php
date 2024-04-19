<?php

function somme ($a, $b) {
    $result = (int)$a + (int)$b;
    echo "Le résultat de l'opération: " . $result;
}

function soustraction ($a, $b) {
    $result = (int)$a - (int)$b;
    echo "Le résultat de l'opération: " . $result;
}

function multiplication ($a, $b) {
    $result = (int)$a * (int)$b;
    echo "Le résultat de l'opération: " . $result;
}

function division ($a, $b) {
    $result = (int)$a / (int)$b;
    echo "Le résultat de l'opération: " . $result;
}

function exposant ($a, $b) {
    $result = (int)$a ** (int)$b;
    echo "Le résultat de l'opération: " . $result;
}

function modulo ($a, $b) {
    $result = (int)$a % (int)$b;
    echo "Le résultat de l'opération: " . $result;
}
