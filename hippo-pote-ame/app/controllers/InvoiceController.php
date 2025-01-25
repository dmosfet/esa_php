<?php

namespace App\Controllers;
use App\Models\Invoice;
use App\Models\SessionClient;

class InvoiceController extends Controller {
    function index() {
        $titre= 'Listings des factures';
        $invoices = Invoice::all();
        $sessionclients = SessionClient::all();
        render('invoice.index',compact('invoices','titre'));
    }
    function create() {
        $titre= 'Facturer une période à un client';
        $invoices = Invoice::all();
        render('invoice.index',compact('invoices','titre'));
    }

}
