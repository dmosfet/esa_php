<?php

namespace App\Controllers;

use App\Models\Temperament;

class TemperamentController extends Controller {

    function index() {
        $titre= 'Temperaments';
        $temperaments= Temperament::select('TemperamentId','TemperamentName')->orderBy('TemperamentId','DESC')->get();
        render('temperament.index',compact('temperaments','titre'));
    }

    function details(int $TemperamentId) {
        $titre= "Fiche Client";
        $temperaments = Temperament::where('TemperamentId', $TemperamentId)->get();
        render('temperament.details',compact('temperaments','titre','TemperamentId'));
    }

    function edit(int $TemperamentId) {
        $titre= 'Modifier un caractère';
        $temperaments = Temperament::where('TemperamentId', $TemperamentId)->get();
        render('temperament.edit',compact('temperaments','titre','TemperamentId'));
    }
    function update() {
        $data=request()->postData();
        $temperament = Temperament::find($data['TemperamentId']);
        $temperament->TemperamentName = $data['TemperamentName'];
        $temperament->save();
        response()->redirect(route('temperaments.details',$data['TemperamentId']));
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
        $temperament->TemperamentName = $data['TemperamentName'];
        $temperament->save();
        response()->redirect('/temperaments');
    }
}

