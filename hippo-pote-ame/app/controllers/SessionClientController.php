<?php

namespace App\Controllers;

use App\Models\Client;
use App\Models\Session;
use App\Models\SessionClient;
use App\Models\SessionPony;

class SessionClientController extends Controller
{
    /**
     * Permet de récupérer les informations nécessaires à la création du formulaire de modification du
     * client de la session
     * @return void
     */
    function edit()
    {
        $SessionId = $_POST['SessionId'];
        $ClientId = $_POST['ClientId'];
        $titre = 'Modifier une inscription';
        $sessionclient = SessionClient::with('client', 'session')->where([['SessionId', $SessionId], ['ClientId', $ClientId]])->first();
        render('sessionclient.edit', compact('sessionclient', 'titre'));
    }

    /**
     * Permet de récupérer les données pour la création du formulaire de création d'un lien entre Client et Session
     * @param integer $SessionId     Paramètre qui identifie la session à laquelle le client s'inscrit
     * @param integer $Number        Paramètre qui identifie le client qui s'inscrit à une session
     * @return void
     */
    function create($SessionId, $Number)
    {
        $sessionclient = new SessionClient();

        // Récupère les informations de la session dans laquelle le ou les clients s'inscrivent
        $session = Session::where('SessionId', $SessionId)->first();

        // Récupère les clients qui peuvent s'inscrire en fonction du type d'événement.
        // 1 -> réservé aux entreprise
        // 2 -> réservé aux particulier
        // 3 -> ouvert à tous
        if ($session->SessionTypeId != 3) {
            $clients = Client::whereDoesntHave('sessions', function ($query) use ($SessionId) {
                $query->where('session_clients.SessionId', $SessionId);
            })->where('ClientTypeId', '=', $session->SessionTypeId)->get();
        } else {
            $clients = Client::whereDoesntHave('sessions', function ($query) use ($SessionId) {
                $query->where('session_clients.SessionId', $SessionId);
            })->get();
        }
        // Compte le nombre de clients déjà inscrits
        $reservedclients= SessionClient::where('session_clients.SessionId', $SessionId)->count();
        $titre = 'Inscrire un client à une session';
        render('sessionclient.create', compact('sessionclient', 'session', 'clients', 'titre', 'reservedclients', 'Number'));
    }

    /**
     * Enregistre une inscription d'un client dans une session
     * @return void
     */
    function store()
    {
        $clients = request()->postData();
        $SessionId = $clients['SessionId'];
        foreach ($clients['Clients'] as $client) {
            $sessionclient = new SessionClient();
            $sessionclient->ClientId = $client['ClientId'];
            $sessionclient->SessionId = $SessionId;
            $sessionclient->Price = $client['Price'];
            $sessionclient->Paid = $client['Paid'];
            $sessionclient->save();
        }
        response()->redirect('/session/' . $SessionId . '/details');
    }

    /**
     * Supprimer l'inscription d'un client à une session sur base de paramètre reçus d'un formulaire
     *  ClientId -> id du client
     *  SessionId -> id de la session
     *  !!! Il n'est pas autorisé de supprimer une inscription d'un client si elle a été facturée !!!
     * @return void
     */
    function destroy()
    {
        $data = request()->postData();
        // Récupère la session a supprimer sur base des id reçus dans le formulaire pour autant que la référence
        // de la facture soit égale à NF (valeur par défaut d'une inscription)

        $sessionclient = SessionClient::where([['ClientId', $data['ClientId']], ['SessionId', $data['SessionId']], ['Invoice', '=', 'NF']]);

        // Si il trouve la session, il la supprime sinon une erreur est transmise et le formulaire est regénéré
        if ($sessionclient->count() > 0) {
            $sessionclient->delete();
            response()->redirect('/session/' . $data['SessionId'] . '/details');
        }
        $errors[] = 'Impossible de supprimer un client d\'une session déjà facturée';

        // Régénération du formulaire
        $titre = "Fiche Session";
        $SessionId = $data['SessionId'];
        $session = Session::where('SessionId', $data['SessionId'])->first();
        $sessionclients = SessionClient::with('client')->where('SessionId', $SessionId)->get();
        $sessionponies = SessionPony::with('pony')->where('SessionId', $SessionId)->get();
        render('session.details', compact('session', 'sessionclients', 'sessionponies', 'titre', 'SessionId', 'errors'));
    }

}

