<?php

/**
 * @author: Jonathan Istace <jonathan.istace@proximus.be>
 * @description: Cette classe permet de tester si un objet est un palindrome
 */
require 'tools.php';
class Palindrome {

    // L'attribut mot de la classe palindrome est traité pour remplacer les caractères accentués et est mis en minuscule.
    public function __construct(
        private string $mot
    ) {
        $this->mot= stripaccents($this->mot);
        $this->mot = strtolower($this->mot);
    }

    // On teste si l'attribut mot est un palindrome et on exécute la procédure adéquate
    public function testpalindrome () : void {
        if (strrev($this->mot) == $this->mot) {
            $this->palindromeok();
        } else {
            $this->palindromenotok();
        }
    }

    // Procédure qui affiche un résultat déterminé si l'attribut mot est un palindrome
    private function palindromeok():void {
        echo "C'est cool, c'est bien un palindrome";
    }

    // Procédure qui affiche un résultat déterminé si l'attribut mot n'est pas un palindrome
    private function palindromenotok(): void {
        print("Ce mot contenait: " . strlen($this->mot) . " lettres" . "\n");
        print("Mélangeons tout ça: " . str_shuffle($this->mot));
    }
}