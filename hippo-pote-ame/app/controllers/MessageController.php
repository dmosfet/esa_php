<?php

namespace App\Controllers;

use App\Models\Message;
use App\Models\User;

class MessageController extends Controller {

    /**
     * Permet de récupérer les messages de l'utilisateur connecté avec Leaf\Auth
     * @return void
     */
    function index() {
        $titre= 'Mes messages';
        $messages= Message::where('Receiver', '=', auth()->user()->username)->get();
        render('message.index',compact('titre', 'messages'));
    }

    /**
     * Change le statut du message en lu ou non lu
     * @return void
     */
    function readunread() {
        $titre= 'Mes messages';
        $message=Message::where('MessageId', '=', (int)$_POST['MessageId'])->first();
        if ($message->Read == 1 )
            $message->update(['Read' => 0]);
        else {
            $message->update(['Read' => 1]);
        }
        $messages= Message::where('Receiver', '=', auth()->user()->username)->get();
        render('message.index',compact('titre', 'messages'));
    }

    /**
     * Récupère le message complet pour affichage
     * @return void
     */
    function details() {
        $titre= 'Lecture de votre message';
        $message=Message::where('MessageId', '=', (int)$_POST['MessageId'])
            ->with('sender', 'receiver')
            ->first();
        $message->update(['Read' => 1]);
        render('message.read',compact('titre', 'message'));
    }

    /**
     * Permet de générer un mail à l'utilisateur "Admin" pour demander la mise à jour de son rôle
     * dans l'application (basé sur Leaf\Auth)
     * @return void
     */
    function updaterole() {
        $sender=User::where('username','=',$_POST['username'])->first();
        $message= new Message();
        $message->Sender = $sender->username;
        $message->Receiver = 'Admin';
        $message->Object='Augmentation de mes rôles';
        $message->Message=$sender->username .' aimerait obtenir le rôle de: ' . $_POST['role'] .'.';
        $message->save();
        response()->redirect(route('dashboard.index'));
    }

    /**
     * Permet de supprimer un message basé sur un ID passé dans un formulaire.
     * @return void
     */
    function destroy() {
        $message= Message::where('MessageId', '=', (int)$_POST['MessageId'])->first();
        $message->delete();
        response()->redirect(route('messages.index'));
    }
}
