<?php

namespace App\Controllers;

use App\Models\Client;
use App\Models\Session;
use App\Models\SessionClient;
use Illuminate\Support\Facades\Redirect;

class SessionClientController extends Controller
{
    function edit(int $SessionId, int $ClientId)
    {
        $titre = 'Modifier une inscription';
        $sessionclients = SessionClient::with('client')->where([['SessionId', $SessionId],['ClientId',$ClientId]])->get();
        render('sessionclient.edit', compact('sessionclients', 'titre',));
    }

    function create($SessionId)
    {
        $sessionclient = new SessionClient();
        $session = Session::where('SessionId', $SessionId)->first();
        $clients = Client::all();
        $titre = 'Inscrire un client à une session';
        render('sessionclient.create', compact('sessionclient', 'session', 'clients', 'titre'));
    }

    function store()
    {
        $data = request()->postData();
        $sessionclient = new SessionClient();
        $sessionclient->ClientId = $data['ClientId'];
        $sessionclient->SessionId = $data['SessionId'];
        $sessionclient->Price = $data['Price'];
        if($data['Paid']==="Non") {
            $sessionclient->Paid = 0;
        } else {
            $sessionclient->Paid = 1;
        }
        $sessionclient->save();
        response()->redirect('/session/' . $data['SessionId'] . '/details');
    }

    function destroy()
    {
        $data = request()->postData();
        $sessionclient= SessionClient::where([['ClientId',$data['ClientId']],['SessionId',$data['SessionId']]]);
        $sessionclient->delete();
        response()->redirect('/session/' . $data['SessionId'] . '/details');
    }

    function update()
    {
        $data = request()->postData();
        $sessionclient = SessionClient::where('SessionId',$data['SessionId'])->where("ClientId",$data['ClientId'])->first();
        $sessionclient->ClientId = $data['ClientId'];
        $sessionclient->SessionId = $data['SessionId'];
        $sessionclient->Price = $data['Price'];
        $sessionclient->Paid = $data['Paid'];
        $sessionclient->save();
        response()->redirect(route('invoices.index'));
    }
}

