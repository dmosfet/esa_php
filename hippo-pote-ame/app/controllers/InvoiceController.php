<?php

namespace App\Controllers;
use App\Models\Invoice;
use App\Models\SessionClient;
use DateTime;

class InvoiceController extends Controller {
    function index() {
        $titre= 'Listings des factures';
        $invoices = Invoice::all();
        render('invoice.index',compact('invoices','titre'));
    }
    function generate() {
        $Year = $_POST['Year'];
        $Month = $_POST['Month'];
        $date = new DateTime($Year.'-'.$Month.'-01');
        $begin = $date->modify('first day of this month')->format('Y-m-d');
        $date = new DateTime($Year.'-'.$Month.'-01');
        $end = $date->modify('last day of this month')->format('Y-m-d');
        $filteredsessionclients = SessionClient::with('Session', 'Client')
            ->whereHas('session', function ($query) use ($end, $begin) {
            $query->whereBetween('DateSession', [$begin, $end]); })
            ->get()
            ->groupBy('ClientId');
        $titre= 'Facturer la période aux clients';
        render('invoice.generate',compact('filteredsessionclients','Year', 'Month','titre'));
    }

    function store() {
        $data=request()->postData();
        $invoice = new Invoice();
        $invoice->Reference = $data['Reference'];
        $invoice->Year = $data['Year'];
        $invoice->Month = $data['Month'];
        $invoice->ClientId = $data['ClientId'];
        $invoice->SessionIdList = $data['SessionIdList'];
        $invoice->HTVA = substr($data['HTVA'],0,-4);
        $invoice->TVA = substr($data['TVA'],0,-4);
        $invoice->TVAC = substr($data['TVAC'],0,-4);
        $invoice->Paid = substr($data['Paid'],0,-4);
        $invoice->save();
        $SessionIdList = explode(',',$data['SessionIdList']);
        SessionClient::whereIn('SessionId', $SessionIdList)
            ->where('ClientId', (int)$data['ClientId'])
            ->update(['Invoice' => $data['Reference']]);
        response()->redirect(route('invoices.index'));
    }

    function destroy() {
        $InvoiceId = $_POST['InvoiceId'];
        $invoice = Invoice::findOrFail($InvoiceId);
        if ($invoice) {
            SessionClient::where('Invoice', $invoice->Reference)->update(['Invoice' => null]);
            $invoice->delete();
        }
        response()->redirect(route('invoices.index'));
    }

}
