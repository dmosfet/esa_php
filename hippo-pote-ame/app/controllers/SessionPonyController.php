<?php

namespace App\Controllers;

use App\Models\Pony;
use App\Models\SessionPony;
use App\Models\Session;

class SessionPonyController extends Controller {
    /**
     * Prépare les éléments pour générer le formulaire de modification d'une attribution de poney à une session
     * @param int $SessionId    Paramètre qui identifie la session
     * @param int $PonyId   Paramètre qui identifie le poney
     * @return void
     */
    function edit(int $SessionId, int $PonyId)
    {
        $titre = 'Modifier une attribution';
        $sessionponies = SessionPony::with('pony')->where([['SessionId', $SessionId],['PonyId',$PonyId]])->get();
        render('sessionpony.edit', compact('sessionponies', 'titre',));
    }


    /**
     * Prépare les éléments pour générer le formulaire d'attribution d'un poney à une session
     * @param int $SessionId  Paramètre qui identifie la session
     * @param int $Number   Paramètre qui indique le nombre de poney à attribuer
     * @return void
     */
    function create($SessionId, $Number)
    {
        // On prépare un nouvel enregistrement de la table pivot Session |Pony
        $sessionpony = new SessionPony();

        // Récupère les informations de la session pour laquelle on attribue un ou plusieurs poneys
        $session = Session::where('SessionId', $SessionId)->first();

        // Liste les poneys qui sont disponibles (non déjà attribué à cette session)
        $ponies = Pony::with('HourPlanned', 'HourDone')
            ->whereDoesntHave('sessions', function ($query) use ($SessionId) {
                $query->where('session_ponies.SessionId', $SessionId);
            })->get();

        // Compte le nombre de poney qui serai déjà associé à la session
        $reservedponies= SessionPony::where('session_ponies.SessionId', $SessionId)
            ->count();

        $titre = 'Attribuer un poney à une session';
        render('sessionpony.create', compact('sessionpony', 'session', 'ponies', 'titre', 'Number', 'reservedponies'));
    }

    /**
     * Enregistre un nouvel élément de la table qui associe un poney à une session
     * @return void
     */
    function store()
    {
        $id = request()->postData()['SessionId'];
        foreach (request()->postData()['PonyId'] as $key => $value) {
            $sessionponies = new SessionPony();
            $sessionponies['SessionId'] = $id;
            $sessionponies['PonyId'] = $value;
            $sessionponies->save();
        }
        response()->redirect('/session/' . $id . '/details');
    }

    /**
     * Supprime une association entre un poney et une session
     * @return void
     */
    function destroy()
    {
        $data = request()->postData();
        $sessionpony= SessionPony::where([['PonyId',$data['PonyId']],['SessionId',$data['SessionId']]]);
        $sessionpony->delete();
        response()->redirect('/session/' . $data['SessionId'] . '/details');
    }
}
