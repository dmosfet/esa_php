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

    function edit() {
        $titre= 'Modifier un client';
        $clients = Client::select('ClientId','ClientName','ClientEmail')->orderBy('ClientId','DESC')->get();
        //$ponies = Pony::all();
        render('client.edit',compact('clients','titre'));
    }
}
