<?php

namespace App\Controllers;

use App\Models\Pony;

class PonyController extends Controller {

    function index() {
        $titre= 'Listing des poneys';
        $ponies = Pony::with('Temperament')->get();
        //$ponies = Pony::join('Temperament', 'Pony.PonyTemperamentId', '=', 'Temperament.TemperamentId')
        //   ->select('Pony.PonyName', 'Temperament.TemperamentName')
        //    ->get();

        render('pony.index',compact('ponies','titre'));
    }
    function edit() {
        $titre= 'Modifier un poney';
        $ponies = Pony::select('PonyId','PonyName','PonyTemperamentId')->orderBy('PonyId','DESC')->get();
        //$ponies = Pony::all();
        render('pony.edit',compact('ponies','titre'));
    }
}
