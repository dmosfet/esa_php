<?php

namespace App\Controllers;

class KpiController extends Controller {
    function index() {
        $titre= 'Statistiques';
        render('kpi.index',compact('titre'));
    }
}
