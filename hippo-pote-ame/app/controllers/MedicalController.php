<?php

namespace App\Controllers;

use App\Models\MedicalRecord;
use App\Models\Pony;

class MedicalController extends Controller {

    /**
     * Permet de récupérer les rapports médicaux des poneys. Il est possible de n'afficher que ceux du poney dont l'Id
     * est passé en paramètre
     * @param integer|String $PonyId    Paramètre qui permet de filter les rapports médicaux d'un poney
     *  'all' => Tous les poneys
     *  'id' => Les rapports du poney qui porte cet id
     * @return void
     */
    function index($PonyId=null) {
        $page = $_GET['page'] ?? 1;
        $parPage = 5;
        $titre= 'Liste des rapports médicaux';
        if ($PonyId != 'all') {
            $records = MedicalRecord::with('Pony')
                ->where('PonyId', $PonyId)
                ->paginate($parPage,['*'], 'page', $page);

        } else {
            $records = MedicalRecord::with('Pony')->paginate($parPage,['*'], 'page', $page);
        }
        render('medical.index',compact('records','titre'));
    }

    /**
     * Permet de modifier un rapport médical sur base d'éléments fournis par un formulaire
     * @return void
     */
    function update() {
        $data=request()->postData();
        $medical = MedicalRecord::where('RecordId',$data['RecordId'])->first();
        $medical->Date = $data['Date'];
        $medical->Description = $data['Description'];
        $medical->save();
        response()->redirect(route('medicals.index'));
    }

    /**
     * Permet de récupérer les éléments pour générer un formulaire de modification d'un rapport médical
     * @return void
     */
    function edit() {
        $RecordId = $_POST['RecordId'];
        $titre= 'Modifier un rapport médical';
        $record= MedicalRecord::with('Pony')
            ->where('RecordId', $RecordId)
            ->first();
        render('medical.edit',compact('record','titre'));
    }

    /**
     * Permet de générer les éléments pour créer un formulaire de création d'un rapport médical
     * @return void
     */
    function create()
    {
        $record = new MedicalRecord();
        $titre= 'Créer un nouveau rapport médical';
        $ponies=Pony::all();
        render('medical.create',compact('record', 'ponies','titre'));
    }

    /**
     * Permet d'enregistrer un rapport médical sur base d'éléments fournis par un formulaire
     * @return void
     */
    function store()
    {
        $data=request()->postData();
        $record= new MedicalRecord();
        $record->PonyId = $data['PonyId'];
        $record->Date = $data['Date'];
        $record->Description = $data['Description'];
        $record->save();
        response()->redirect('/ponies/all/medical');
    }

    /**
     * Permet de supprimer un rapport médical sur base de son ID fourni par un formulaire POST
     * @return void
     */
    function destroy() {
        $RecordId=$_POST['RecordId'];
        $record = MedicalRecord::findOrFail($RecordId);
        if ($record) {
            $record->delete();
        }
        response()->redirect(route('medicals.index'));
    }
}
