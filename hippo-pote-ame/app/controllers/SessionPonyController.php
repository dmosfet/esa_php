<?php

namespace App\Controllers;

use App\Models\Pony;
use App\Models\SessionPony;
use App\Models\Session;

class SessionPonyController extends Controller {
    function edit(int $SessionId, int $PonyId)
    {
        $titre = 'Modifier une attribution';
        $sessionponies = SessionPony::with('pony')->where([['SessionId', $SessionId],['PonyId',$PonyId]])->get();
        render('sessionpony.edit', compact('sessionponies', 'titre',));
    }

    function create($SessionId)
    {
        $sessionpony = new SessionPony();
        $session = Session::where('SessionId', $SessionId)->first();
        $ponies = Pony::all();
        $titre = 'Attribuer un poney à une session';
        render('sessionpony.create', compact('sessionpony', 'session', 'ponies', 'titre'));
    }

    function store()
    {
        $data = request()->postData();
        $sessionpony = new SessionPony();
        $sessionpony->PonyId = $data['PonyId'];
        $sessionpony->SessionId = $data['SessionId'];
        $sessionpony->save();
        response()->redirect('/session/' . $data['SessionId'] . '/details');
    }

    function destroy()
    {
        $data = request()->postData();
        $sessionpony= SessionPony::where([['PonyId',$data['PonyId']],['SessionId',$data['SessionId']]]);
        $sessionpony->delete();
        response()->redirect('/session/' . $data['SessionId'] . '/details');
    }
}
