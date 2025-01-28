<?php

namespace App\Controllers;

use App\Models\User;

class DashboardController extends Controller {

    public function index()
    {
        $user=new User();
        $data = auth()->data();
        $titre= 'Tableau de bord de l\'utilisateur';
        render('dashboard.index',compact('user','data','titre'));
    }
}
