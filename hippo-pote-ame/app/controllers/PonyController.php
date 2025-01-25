<?php

namespace App\Controllers;

use App\Models\Pony;
use App\Models\Temperament;

class PonyController extends Controller {

    function index() {
        $titre= 'Listing des poneys';
        $ponies = Pony::with('Temperament')
            ->orderBy('Name', 'ASC')
            ->get();
        render('pony.index',compact('ponies','titre'));
    }

    function details($PonyId) {
        $titre= "Carte d'identité d'un poney";
        $pony= Pony::with('Temperament')
            ->where('PonyId', $PonyId)
            ->first();
        render('pony.details',compact('pony','titre','PonyId'));
    }

    function edit() {
        $PonyId = $_POST['PonyId'];
        $titre= 'Modifier un poney';
        $pony= Pony::with('Temperament')
            ->where('PonyId', $PonyId)
            ->first();
        $temperaments = Temperament::all();
        render('pony.edit',compact('pony','temperaments','titre','PonyId'));
    }

    function update() {
        $data=request()->postData();
        $pony = Pony::find($data['PonyId']);
        $pony->Name = $data['Name'];
        $pony->DateOfBirth = $data['DateOfBirth'];
        $pony->Height = $data['Height'];
        $pony->TemperamentId = $data['TemperamentId'];
        $pony->MaxWorkHour = $data['MaxWorkHour'];
        $pony->save();
        response()->redirect(route('ponies.details',$data['PonyId']));
    }

    function create()
    {
        $pony = new Pony();
        $titre= 'Créer un nouveau poney';
        $temperaments = Temperament::all();
        render('pony.create',compact('pony','titre','temperaments'));
    }

    function store()
    {
        $data=request()->postData();
        $pony = new Pony();
        $pony->Name = $data['Name'];
        $pony->DateOfBirth = $data['DateOfBirth'];
        $pony->Height = $data['Height'];
        $pony->TemperamentId = $data['TemperamentId'];
        $pony->MaxWorkHour = $data['MaxWorkHour'];
        $pony->save();
        response()->redirect(route('ponies.index'));
    }
    function destroy()
    {
        $PonyId = $_POST['PonyId'];
        $pony = Pony::findOrFail($PonyId);
        if ($pony) {
            $pony->delete();
        }
        response()->redirect(route('ponies.index'));
    }
}
