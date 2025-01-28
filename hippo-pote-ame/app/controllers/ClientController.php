<?php

namespace App\Controllers;

use App\Models\Client;

class ClientController extends Controller {

    function index($type=null) {
        $titre= 'Liste de nos clients';
        if ($type == 'society') {
            $clients = Client::with('ClientType')
                ->where('ClientTypeId', 1)
                ->orderBy('SocietyName','ASC')
                ->orderBy('LastName','ASC')
                ->get();

        } elseif ($type == 'private') {
            $clients = Client::with('ClientType')
                ->where('ClientTypeId', 2)
                ->orderBy('SocietyName','ASC')
                ->orderBy('LastName','ASC')
                ->get();
        } else {
            $clients = Client::with('ClientType')
                ->orderBy('SocietyName','ASC')
                ->orderBy('LastName','ASC')
                ->get();
        }

        render('client.index',compact('clients','titre'));
    }

    function details($ClientId) {
        $titre= "Fiche Client";
        $client = Client::with('ClientType')
            ->where('ClientId', $ClientId)
            ->first();
        render('client.details',compact('client','titre'));
    }

    function edit() {
        $ClientId = $_POST['ClientId'];
        $titre= 'Modifier un client';
        $client = Client::with('ClientType')
            ->where('ClientId', $ClientId)
            ->first();
        render('client.edit',compact('client','titre'));
    }

    function update() {
        $data=request()->postData();
        $client = Client::find($data['ClientId']);
        if ($data['ClientTypeId']==="1"):
            $client->SocietyName = $data['SocietyName'];
            $client->BCE = $data['BCE'];
            $client->LastName = $data['LastName'];
            $client->FirstName = $data['FirstName'];
            $client->Email = $data['Email'];
            $client->Telephone = $data['Telephone'];
            $client->Address = $data['Address'];
            $client->Number = $data['Number'];
            $client->ZipCode = $data['ZipCode'];
            $client->City = $data['City'];
        else:
            $client->LastName = $data['LastName'];
            $client->FirstName = $data['FirstName'];
            $client->DateOfBirth = $data['DateOfBirth'];
            $client->Email = $data['Email'];
            $client->Telephone = $data['Telephone'];
            $client->Address = $data['Address'];
            $client->Number = $data['Number'];
            $client->ZipCode = $data['ZipCode'];
            $client->City = $data['City'];
        endif;
        $client->save();
        response()->redirect(route('clients.details',$data['ClientId']));
    }

    function create()
    {
        $client = new Client();
        $titre= 'Créer un nouveau client';
        render('client.create',compact('client','titre'));
    }

    function store()
    {
        $data=request()->postData();
        $client = new Client();
        $client->ClientTypeId = $data['ClientTypeId'];
        if ($data['ClientTypeId']==="1"):
            $client->SocietyName = $data['SocietyName'];
            $client->BCE = $data['BCE'];
            $client->LastName = $data['LastName'];
            $client->FirstName = $data['FirstName'];
            $client->Email = $data['Email'];
            $client->Telephone = $data['Telephone'];
            $client->Address = $data['Address'];
            $client->Number = $data['Number'];
            $client->ZipCode = $data['ZipCode'];
            $client->City = $data['City'];
        else:
            $client->LastName = $data['LastName'];
            $client->FirstName = $data['FirstName'];
            $client->DateOfBirth = $data['DateOfBirth'];
            $client->Email = $data['Email'];
            $client->Telephone = $data['Telephone'];
            $client->Address = $data['Address'];
            $client->Number = $data['Number'];
            $client->ZipCode = $data['ZipCode'];
            $client->City = $data['City'];
        endif;
        $client->save();
        response()->redirect('/clients');
    }

    function destroy()
    {
        $ClientId = $_POST['ClientId'];
        $client = Client::findOrFail($ClientId);
        if ($client) {
            $client->delete();
        }
        response()->redirect(route('clients.index'));;
    }
}
