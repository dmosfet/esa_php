<?php

namespace App\Controllers;

use App\Models\MedicalRecord;

class MedicalController extends Controller {

    function index() {
        $titre= 'Liste des examens médicaux';
        $records = MedicalRecord::with('Pony')->get();
        render('medical.index',compact('records','titre'));
    }
    function update() {
        $data=request()->postData();
        $medical = MedicalRecord::where('RecordId',$data['RecordId'])->first();
        $medical->Name = $data['Name'];
        $medical->Description = $data['Description'];
        $medical->save();
        response()->redirect(route('medicals.index'));
    }

    function create()
    {
        $temperament = new MedicalRecord();
        $titre= 'Créer un nouveau tempérament';
        render('medical.create',compact('temperament','titre'));
    }

    function store()
    {
        $data=request()->postData();
        $temperament= new MedicalRecord();
        $temperament->Name = $data['Name'];
        $temperament->Description = $data['Description'];
        $temperament->save();
        response()->redirect('/ponies/medical');
    }

    function destroy() {
        $TemperamentId=$_POST['TemperamentId'];
        $temperament = MedicalRecord::findOrFail($TemperamentId);
        if ($temperament) {
            $temperament->delete();
        }
        response()->redirect(route('medicals.index'));
    }
}
