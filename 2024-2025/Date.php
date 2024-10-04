<?php
class Date{

    public function __construct(
        public int $jour,
        public int $mois,
        public int $annee
    )
    {
        echo 'Création de l\'objet';
    }

//    public function __destruct() {
//        echo 'Destruction de l\'objet';
//    }
}