<?php

class Palindrome {

    public function __construct(
        public string $mot
    ) {
    }

    public function testpalindrome () : void {
        if (strrev(strtolower($this->mot)) == strtolower($this->mot)) {
            $this->palindromeok();
        } else {
            $this->palindromenotok();
        }
    }

    private function palindromeok():void {
        echo "C'est cool, c'est bien un palindrome";
    }

    private function palindromenotok(): void {
        print("Ce mot contenait: " . strlen($this->mot) . " lettres" . "\n");
        print("Mélangeons tout ça: " . str_shuffle($this->mot));
    }
}