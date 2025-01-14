<?php

namespace App\Controllers;

use App\Models\Pony;
use App\Models\Temperament;

class PonyController extends Controller {

    function index() {
        $titre= 'Listing des poneys';
        $ponies = Pony::with('Temperament')->get();
        render('pony.index',compact('ponies','titre'));
    }

    function details(int $PonyId) {
        $titre= "Carte d'identité d'un poney";
        $ponies = Pony::where('PonyId', $PonyId)->with('Temperament')->get();
        render('pony.details',compact('ponies','titre','PonyId'));
    }

    function edit(int $PonyId) {
        $titre= 'Modifier un poney';
        $ponies = Pony::where('PonyId', $PonyId)->with('Temperament')->get();
        $temperaments = Temperament::all();
        render('pony.edit',compact('ponies','temperaments','titre','PonyId'));
    }

    function update() {
        $data=request()->postData();
        $pony = Pony::find($data['PonyId']);
        $pony->PonyName = $data['PonyName'];
        $pony->PonyTemperamentId = $data['PonyTemperamentId'];
        $pony->PonyMaxWorkHour = $data['PonyMaxWorkHour'];
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
        $pony->PonyName = $data['PonyName'];
        $pony->PonyTemperamentId = $data['PonyTemperamentId'];
        $pony->PonyMaxWorkHour = $data['PonyMaxWorkHour'];
        $pony->save();
        response()->redirect('/ponies');
    }
}
