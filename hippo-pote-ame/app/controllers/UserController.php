<?php

namespace App\Controllers;

use App\Models\Message;
use App\Models\User;
use Exception;
use Leaf\Auth;

class UserController extends Controller
{
    /**
     * Permet de générer les éléments qui serviront à afficher la liste des utilisateurs en fonction de leur rôle
     * @param String $Role      Paramètre qui filtre le rôle de l'utilisateur à afficher
     * @return void
     */
    function index($Role = null)
    {
        $page = $_GET['page'] ?? 1;
        $parPage = 5;
        $titre = 'Liste des utilisateurs';
        if ($Role != "all") {
            $users = User::where('leaf_auth_user_roles', 'like', "%{$Role}%")
                ->paginate($parPage, ['*'], 'page', $page)
                ->withPath('/users');
        } else {
            $users = User::paginate($parPage, ['*'], 'page', $page)
                ->withPath('/users');
        }
        render('user.index', compact('users', 'titre'));
    }

    /**
     * Permet de récupérer les éléments d'un utilisateur spécifique à afficher
     * @param int $id  Paramètre qui identifie l'utilisateur
     * @return void
     */
    function details($id)
    {
        $user = User::find($id);
        $titre = "Fiche utilisateur";
        render('user.details', compact('user', 'titre'));
    }

    /**
     * Permet de générer les éléments pour la création du formulaire de création d'un utilisateur
     * @return void
     */
    function create()
    {
        $titre = 'Ajout d\'un utilisateur';
        $user = new User();
        render('user.create', compact('user', 'titre'));
    }

    /**
     * Enregistre un nouvel utilisateur depuis le menu utilisateur
     * @return void
     *
     */
    function store()
    {
        $titre = 'Ajout d\'un utilisateur';
        $data = request()->postData();

        // On utilise les methodes de Leaf Auth pour créer l'utilisateur

        // Création de l'utilisateur
        $user = auth()->createUserFor([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => $data['password'],
        ]);

        // Si la création a résussi, on lui attribue le rôle de Guest, sinon on renvoi une erreur dans le
        // formulaire de création.
        if ($user) {
            $Role = 'guest';
            $user->assign($Role);
            response()->redirect(route('users.index', $Role));
        } else {
            $errors = auth()->errors();
            $titre = 'Ajout d\'un utilisateur';
            $user = new User();
            render('user.create', compact('user', 'titre', 'errors'));
        }

    }

    /**
     * Permet de générer le formulaire de modification d'un utilisateur
     * @param int $mode Paramètre qui identifie l'utilisateur à modifier
     * @return void
     */
    public function edit($mode = null)
    {
        $id = $_POST['id'];
        $roles = auth()->roles();
        $titre = " Modifier un utilisateur";
        $user = User::where('id', $id)->first();
        render('user.edit', compact('user', 'titre', 'roles', 'mode'));
    }

    /**
     * Update d'un utilisateur en fonction d'un type de modification passée via une formulaire POST
     *  'pwd' => modification du mot de passe de l'utilisateur
     *  'role' => modification du rôle de l'utilisateur
     *  'default' => modification uniquement de l'adresse mail
     * !!! La modification de l'username n'est pas possible !!!
     * @return void
     */
    public function update()
    {
        $data = request()->postData();
        switch ($data['modificationtype']) {
            case ('pwd');
                $user = User::find($data['id']);
                $user->password = password_hash($data['password'], PASSWORD_DEFAULT);
                $user->save();
                break;
            case ('roles');
                $user = auth()->find($data['id']);
                $user->unassign($data['deleterole']);
                $user->assign($data['addrole']);
                break;
            default;
                $user = User::find($data['id']);
                $user->email = $data['email'];
                $user->save();
        }
        response()->redirect(route('users.index', $data['modificationtype']));
    }

    /**
     * Permet de supprimer un utilisateur
     * @param int $mode Paramètre qui identifie l'utilisateur à modifier
     * @return void
     */
    public function destroy()
    {
        $id = $_POST['id'];
        $titre = 'Liste des utilisateurs';
        $roles = auth()->roles();
        $errors = [];
        $user = User::find($id);
        if ($user) {
            $messages = Message::where('sender', '=', $user->username)->orWhere('receiver', '=', $user->username)->delete();
            $user->delete();
        } else {
            $page = $_GET['page'] ?? 1;
            $parPage = 5;
            $errors[] = 'Impossible de supprimer l\'utilisateur';
            $users = User::paginate($parPage, ['*'], 'page', $page)
                ->withPath('/users');
            render('user.index', compact('users', 'titre', 'roles', 'errors'));
        }
        response()->redirect(route('users.index', 'all'));
    }


}
