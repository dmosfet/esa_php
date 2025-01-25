<?php

namespace App\Controllers;

use App\Models\Temperament;

class TemperamentController extends Controller {

    function index() {
        $titre= 'Temperaments';
        $temperaments= Temperament::all()->sortBy('TemperamentId');
        render('temperament.index',compact('temperaments','titre'));
    }

    function details($TemperamentId) {
        $titre= "Définition du tempérament";
        $temperament = Temperament::where('TemperamentId',$TemperamentId)->first();
        render('temperament.details',compact('temperament','titre','TemperamentId'));
    }

    function edit() {
        $TemperamentId = $_POST['TemperamentId'];
        $titre= 'Modifier un caractère';
        $temperament = Temperament::where('TemperamentId',$TemperamentId)->first();
        render('temperament.edit',compact('temperament','titre'));
    }

    function update() {
        $data=request()->postData();
        $temperament = Temperament::where('TemperamentId',$data['TemperamentId'])->first();
        $temperament->Name = $data['Name'];
        $temperament->Description = $data['Description'];
        $temperament->save();
        response()->redirect(route('temperaments.index'));
    }

    function create()
    {
        $temperament = new Temperament();
        $titre= 'Créer un nouveau tempérament';
        render('temperament.create',compact('temperament','titre'));
    }

    function store()
    {
        $data=request()->postData();
        $temperament= new Temperament();
        $temperament->Name = $data['Name'];
        $temperament->Description = $data['Description'];
        $temperament->save();
        response()->redirect('/temperaments');
    }

    function destroy() {
        $TemperamentId=$_POST['TemperamentId'];
        $temperament = Temperament::findOrFail($TemperamentId);
        if ($temperament) {
            $temperament->delete();
        }
        response()->redirect(route('temperaments.index'));
    }
}

