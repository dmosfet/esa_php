<?php

namespace App\Controllers;

class MainController extends Controller {

    function index() {
        $titre= 'Accueil';
        render('main.index',compact('titre'));
    }
}
