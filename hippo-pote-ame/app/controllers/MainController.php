<?php

namespace App\Controllers;

use App\Models\Pony;

class MainController extends Controller {

    function index() {
        $titre= 'Welcome Page';
        render('main.index',compact('titre'));
    }
}
