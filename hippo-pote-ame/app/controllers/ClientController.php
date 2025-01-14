<?php

namespace App\Controllers;

use App\Models\Client;

class ClientController extends Controller {

    function index() {
        $titre= 'Clients';
        $clients = Client::select('ClientId','ClientName', 'ClientEmail')->orderBy('ClientId','DESC')->get();
        //$customers = Customer::all();
        render('client.index',compact('clients','titre'));
    }

    function details(int $ClientId) {
        $titre= "Fiche Client";
        $clients = Client::where('ClientId', $ClientId)->get();
        render('client.details',compact('clients','titre','ClientId'));
    }

    function edit(int $ClientId) {
        $titre= 'Modifier un client';
        $clients = Client::where('ClientId', $ClientId)->get();
        render('client.edit',compact('clients','titre','ClientId'));
    }
}
