<?php

namespace App\Controllers;

use App\Models\User;

class UserController extends Controller {

    function index() {
        $titre= 'Liste des utilisateurs';
        $users = User::all();
        render('user.index',compact('users','titre', ));
    }

    function create() {
        $titre= 'Ajout d\'un utilisateur';
        $user= new User();
        render('user.create',compact('user','titre', ));
    }

    function store() {
        $titre= 'Ajout d\'un utilisateur';
        $data = request()->postData();
        $user = auth()->createUserFor([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => $data['password'],
        ]);

        if ($user) {
            // user is saved
            $user->assign('user');
        } else {
            // user is not saved
            $error = auth()->errors();
            render('user.create',compact('user','error','titre' ));
        }
    }

}
