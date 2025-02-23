<?php

namespace App\Controllers;

use App\Models\User;

class AuthController extends Controller {

    /***
     * Prépare les données pour la vue qui permet d'afficher la page de création d'un nouveau compte
     * @return void
     */
    public function register()
    {
        $user = new User();
        $titre= 'Créer un compte';
        render('auth.register',compact('user','titre'));
    }

    /***
     * Récupère les données d'un formulaire pour créer un nouvel utilisateur en utilisant Leaf\Auth.
     * L'utilisateur est créé avec un profil "Guest" par défaut. En cas de réussite, l'utilisateur est renvoyé vers
     * la page de connexion pour s'authentifier
     * @return void
     * La redirection contient les erreurs rencontrées.
     */
    public function store()
    {
        // Récupération des données du formulaire et utilisation de Leaf\Auth pour la création du compte.
        $data = request()->postData();
        $success = auth()->register([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => $data['password'],
        ]);

        if ($success) {
            // L'utilisateur est enregistré, on lui assigne un rôle par défaut
            auth()->user()->assign('guest');
        } else {
            // L'utilisateur n'est pas enregistré, on renvoie vers le formulaire avec les erreurs
            $titre= 'Créer un compte';
            $error = auth()->errors();
            render('auth.register',compact('error','titre'));
        }
        // On redirige vers la page de connexion
        response()->redirect('/auth/login');
    }

    /***
     * Simple préparation de la vue qui permet à l'utilisateur de se connecter
     * @return void
     */
    public function login()
    {
        $titre= 'Page de connexion';
        render('auth.login',compact('titre'));
    }

    /***
     * Vérifie que les identifiants et mot de passes encodés dans le formulaire sont corrects.
     * En cas de réussite, l'utilisateur est renvoyé sur son espace personnel.
     * @return void
     */
    public function check()
    {
        // Vérification des identifiants avec la méthode login de Leaf\Auth
        $titre= 'Page de connexion';
        $success = auth()->login([
            'username' => $_POST['username'],
            'password' => $_POST['password']
        ]);

        if ($success) {
            // Si l'authentification réussi, on redirige sur son profil
            response()->redirect('/dashboard');
        } else {
            // Si l'authentification échoue, on affiche un message d'erreur
            $errors = auth()->errors();
            render('auth.login',compact('titre','errors'));
        }
    }

    /***
     * Simple fonction de déconnexion du compte en utilisant Leaf\Auth
     * @return null
     */
    public function logout()
    {
        auth()->logout();
        return redirect('/auth/login');
    }
}
