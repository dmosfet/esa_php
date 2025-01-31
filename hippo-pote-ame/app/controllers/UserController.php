<?php

namespace App\Controllers;

use App\Models\User;
use Leaf\Auth;

class UserController extends Controller
{

    function index($Role = null)
    {
        $titre = 'Liste des utilisateurs';
        if ($Role != "all") {
            $users = User::where('leaf_auth_user_roles', 'like', "%{$Role}%")->get();
        } else {
            $users = User::all();
        }
        render('user.index', compact('users', 'titre'));
    }

    function details($id)
    {
        $user = auth()->find(1);
        $roles= $user->roles();
        dd($user, $roles);
        $titre = "Fiche utilisateur";
        render('user.details', compact('user', 'titre'));
    }

    function create()
    {
        $titre = 'Ajout d\'un utilisateur';
        $user = new User();
        render('user.create', compact('user', 'titre'));
    }

    function store()
    {
        $titre = 'Ajout d\'un utilisateur';
        $data = request()->postData();
        $user = auth()->createUserFor([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => $data['password'],
        ]);

        if ($user) {
            // user is saved
            $user->assign('user');
            $Role = 'user';
            response()->redirect(route('users.index', $Role));
        } else {
            // user is not saved
            $error = auth()->errors();
            render('user.create', compact('user', 'error', 'titre'));
        }
    }

    public function edit($mode = null)
    {
        $id = $_POST['id'];
        $roles = auth()->roles();
        $titre = " Modifier un utilisateur";
        $user = User::where('id', $id)->first();
        render('user.edit', compact('user', 'titre', 'roles', 'mode'));
    }

    public function update()
    {
        $data = request()->postData();
        $user = User::find($data['id']);
        switch ($data['modificationtype']) {
            case ('pwd');
                $user->password = $data['password'];
                $user->save();
                break;
            case ('roles');
                $user = auth()->find($data['id']);
                $user->unassign($data['deleterole']);
                $user->assign($data['addrole']);
                break;
            default;
                $user->username = $data['username'];
                $user->email = $data['email'];
                $user->save();
        }
        response()->redirect(route('users.index', $data['modificationtype']));
    }

}
