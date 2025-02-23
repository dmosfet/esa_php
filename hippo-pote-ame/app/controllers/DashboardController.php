<?php

namespace App\Controllers;

class DashboardController extends Controller {

    /***
     * Prépare l'affichage du dashboard de l'utilisateur connecté en utilisant Leaf\Auth
     * @return void
     */
    public function index()
    {
        $data = auth()->data();
        $roles = auth()->roles();
        $titre= 'Tableau de bord de l\'utilisateur';
        render('dashboard.index',compact('data','roles','titre'));
    }
}
