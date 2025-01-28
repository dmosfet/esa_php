<?php

namespace App\Controllers;

use App\Models\User;
use Leaf\Helpers\Password;

class AuthController extends Controller {

    public function register()
    {
        $user = new User();
        $titre= 'Créer un compte';
        render('auth.register',compact('user','titre'));
    }
    public function store()
    {
        $data = request()->postData();
        $success = auth()->register([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => $data['password'],
        ]);

        if ($success) {
            // L'utilisateur est enregistré.
            auth()->user()->assign('user');
        } else {
            // L'utilisateur n'est pas enregistré.
            $titre= 'Créer un compte';
            $error = auth()->errors();
            render('auth.register',compact('error','titre'));
        }
        response()->redirect('/login');
    }

    public function login()
    {
        $titre= 'Page de connexion';
        render('auth.login',compact('titre'));
    }

    public function check()
    {
        $titre= 'Page de connexion';
        $success = auth()->login([
            'username' => $_POST['username'],
            'password' => $_POST['password']
        ]);

        if ($success) {
            // Si l'authentification réussi, on redirige sur son profil
            response()->redirect('/dashboard');
        } else {
            // Si l'authentification échoue, afficher un message d'erreur
            $errors = auth()->errors();
            render('auth.login',compact('titre','errors'));
        }
    }
    public function logout()
    {
        auth()->logout();
        return redirect('/auth/login');
    }
}
