<?php

namespace App\Controllers;
use App\Models\Invoice;
use App\Models\SessionClient;
use DateTime;

class InvoiceController extends Controller {
    function index() {
        $titre= 'Listings des factures';
        $invoices = Invoice::all();
        $sessionclients = SessionClient::all();
        render('invoice.index',compact('invoices','titre'));
    }
    function generate() {
        $year = $_POST['Year'];
        $month = $_POST['Month'];
        $date = new DateTime($year.'-'.$month.'-01');
        $begin = $date->modify('first day of this month')->format('Y-m-d');
        $date = new DateTime($year.'-'.$month.'-01');
        $end = $date->modify('last day of this month')->format('Y-m-d');
        $filteredsessionclients = SessionClient::with('Session', 'Client')
            ->whereHas('session', function ($query) use ($end, $begin) {
            $query->whereBetween('DateSession', [$begin, $end]); })
            ->get()
            ->groupBy('ClientId');
        $titre= 'Facturer la période aux clients';
        render('invoice.generate',compact('filteredsessionclients','year', 'month','titre'));
    }

    function create() {
        $titre= 'Créer une facture pour un client';
        $invoice = new Invoice();
        render('invoice.index',compact('invoice','titre'));
    }

}
