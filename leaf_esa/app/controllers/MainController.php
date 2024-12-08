<?php

namespace App\Controllers;

class MainController extends Controller
{
    public function home()
    {
        render('main.home');
    }

    public function about()
    {
        $texte = 'Ceci est mon about';
        render('main.about', ['message'=>$texte]);
    }
}
