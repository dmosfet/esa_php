<?php

require 'Vehicule.php';
class Voiture extends Vehicule
{

    public function __construct()
    {
        parent::__construct();
        $this->nombre_roues = 4;
    }

}