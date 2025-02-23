<?php

namespace App\Controllers;

use App\Models\Temperament;

class TemperamentController extends Controller {

    /**
     * Prépare les élements pour afficher la liste des caractères des poneys
     * @return void
     */
    function index() {
        $titre= 'Temperaments';
        $temperaments= Temperament::all()->sortBy('TemperamentId');
        render('temperament.index',compact('temperaments','titre'));
    }

    /**
     * Prépare l'affichage des détails d'un caractère de poney
     * @param int $TemperamentId    Paramètre qui identifie le caractère
     * @return void
     */
    function details($TemperamentId) {
        $titre= "Définition du tempérament";
        $temperament = Temperament::where('TemperamentId',$TemperamentId)->first();
        render('temperament.details',compact('temperament','titre','TemperamentId'));
    }

    /**
     * Prépare les élements pour générer un formulaire de modification des caractéristiques de températion
     * @return void
     */
    function edit() {
        $TemperamentId = $_POST['TemperamentId'];
        $titre= 'Modifier un caractère';
        $temperament = Temperament::where('TemperamentId',$TemperamentId)->first();
        render('temperament.edit',compact('temperament','titre'));
    }

    /**
     * Update les caractéristiques d'un tempérament de poney.
     * @return void
     */
    function update() {
        $data=request()->postData();
        $temperament = Temperament::where('TemperamentId',$data['TemperamentId'])->first();
        $temperament->Name = $data['Name'];
        $temperament->Description = $data['Description'];
        $temperament->save();
        response()->redirect(route('temperaments.index'));
    }

    /**
     * Prépare le formulaire de création d'un tempérament de Poney
     * @return void
     */
    function create()
    {
        $temperament = new Temperament();
        $titre= 'Créer un nouveau tempérament';
        render('temperament.create',compact('temperament','titre'));
    }

    /**
     * Enregistre un nouveau tempérament de Poney
     * @return void
     */
    function store()
    {
        Temperament::create(request()->postData());
        response()->redirect('/temperaments');
    }

    /**
     * Supprime un témpérament de Poney
     * @return void
     */
    function destroy() {
        $TemperamentId=$_POST['TemperamentId'];
        $temperament = Temperament::findOrFail($TemperamentId);
        if ($temperament) {
            $temperament->delete();
        }
        response()->redirect(route('temperaments.index'));
    }
}

