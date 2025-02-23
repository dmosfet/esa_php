<?php

namespace App\Controllers;

use App\Models\Invoice;
use App\Models\InvoiceSession;
use App\Models\SessionClient;
use DateTime;
use Dompdf\Dompdf;
use Dompdf\Options;
use Leaf\View;

class InvoiceController extends Controller
{

    /***
     * Cette fonction permet d'afficher les factures encodées dans la base de données.
     * Il est possible de les filtrer par client sur base de l'ID.
     * Les résultats sont paginés (4 élements par page)
     * @param integer $ClientId      Paramètre qui permet de modifier la requête qui récupère les factures.
     *  all => toutes les factures
     *  id du client => les factures du client
     * @return void
     */
    function index($ClientId)
    {
        $page = $_GET['page'] ?? 1;
        $parPage = 4;
        $titre = 'Listings des factures';
        if ($ClientId == 'all') {
            $invoices = Invoice::with('client')
                ->orderBy('created_at', 'DESC')
                ->paginate($parPage, ['*'], 'page', $page);
        } else {
            $invoices = Invoice::with('client')
                ->where('ClientId', '=', $ClientId)
                ->orderBy('created_at', 'DESC')
                ->paginate($parPage, ['*'], 'page', $page);
        }
        render('invoice.index', compact('invoices', 'titre', 'ClientId'));
    }

    /***
     * Permet de récupérer les éléments nécessaires à la visualisation des détails d'une facture basée
     * sur l'ID de la facture
     * @param integer $InvoiceId     Paramètre qui permet de filtrer la requête sur base de l'ID de la facture
     * @return void
     */
    function details($InvoiceId)
    {
        $titre = 'Details de la facture';
        $invoice = Invoice::with('client', 'session')
            ->where('InvoiceId', '=', $InvoiceId)
            ->first();
        $sessionclients = SessionClient::with('session')
            ->where('ClientId', '=', $invoice->ClientId)
            ->whereIn('SessionId', function ($query) use ($InvoiceId) {
                $query->select('SessionId')
                    ->from('invoice_sessions')
                    ->where('InvoiceId', $InvoiceId);
            })->get();
        render('invoice.details', compact('invoice', 'sessionclients', 'titre'));
    }

    /**
     * Permet de générer une facture en pdf en utilisant dompdf
     * @param $InvoiceId integer    Paramètre qui permet de sélectionner la facture à imprimer en pdf sur base de son ID
     * @return void
     */
    function pdf($InvoiceId)
    {
        // On prépare la regénération de la facture mais dans un html
        $titre = 'Details de la facture';
        $invoice = Invoice::with('client')
            ->where('InvoiceId', '=', $InvoiceId)
            ->first();
        $sessionclients = SessionClient::with('session')
            ->where('ClientId', '=', $invoice->ClientId)
            ->whereIn('SessionId', function ($query) use ($InvoiceId) {
                $query->select('SessionId')
                    ->from('invoice_sessions')
                    ->where('InvoiceId', $InvoiceId);
            })->get();

        // On récupère le logo à incruster dans la facture
        $logoPath = __DIR__ . '/../../public/assets/img/hippo-pote-ame.png';
        $type = pathinfo($logoPath, PATHINFO_EXTENSION);
        $data = file_get_contents($logoPath);
        $logo = 'data:image/' . $type . ';base64,' . base64_encode($data);

        // On créé le pdf
        $options = new Options();
        $options->set('defaultFont', 'Arial');
        $dompdf = new Dompdf($options);
        $css = file_get_contents(__DIR__ . "/../../public/assets/css/factures.css");

        // On crée une page Html intégrant le css
        $html = "<style>$css</style>";

        // Charger la vue Blade avec les données de la facture en commencant par le header, puis le corps, puis le footer
        $html .= view('layouts/header_invoice', compact('logo'));
        $html .= view('layouts.main_invoice', compact('invoice', 'titre', 'sessionclients'));
        $html .= view('layouts/footer_invoice');

        // On télécharger l'html dans l'objet puis on choisit la taille avant de le générer
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Télécharger le PDF
        $dompdf->stream("facture_{$invoice->Reference}.pdf", ["Attachment" => true]);
    }

    /***
     * Génère par client et pour une période déterminée par le mois et l'année (passé en paramètres d'un formulaire)
     * une facture qui reprend:
     *      une référence unique
     *      les sessions auxquelles il était inscrit (date, prix et montant déjà payés)
     *      un total des sessions
     *      un prix total HTVA et TVAC, la TVA et le montant déjà payé.
     *      un solde
     * Un tableau associatif est créé pour chaque facture et passé en paramètres pour sa visualisation avant validation
     * @return void
     */
    function generate()
    {
        // On récupère les données du formulaire pour préparer la création d'un nouveau tableau associatif Invoice
        $Year = $_POST['Year'];
        $Month = $_POST['Month'];

        // On calcule les dates pour la requete SQL
        $date = new DateTime($Year . '-' . $Month . '-01');
        $begin = $date->modify('first day of this month')->format('Y-m-d');
        $date = new DateTime($Year . '-' . $Month . '-01');
        $end = $date->modify('last day of this month')->format('Y-m-d');

        // On récupères les éléments de la table Session_clients qui rencontrent les conditions de temps
        $filteredsessionclients = SessionClient::with('Session', 'Client')
            ->whereHas('session', function ($query) use ($end, $begin) {
                $query->whereBetween('DateSession', [$begin, $end])
                    ->where('Invoice', '=', "NF");
            })
            ->get()
            ->groupBy('ClientId');

        // On prépare une array de facture et on parcourt les résultats
        $invoices = [];

        foreach ($filteredsessionclients as $filteredsessionclient) {
            $invoice = [];
            $Reference = $Year . $Month . "/" . $filteredsessionclient[0]->Client->ClientId . '/' . date('dmY');
            if ($filteredsessionclient[0]->Client->ClientTypeId == 1) {
                $ClientName = $filteredsessionclient[0]->Client->SocietyName;
            } else {
                $ClientName = $filteredsessionclient[0]->Client->LastName . " " . $filteredsessionclient[0]->Client->FirstName;
            }
            $invoice = [
                'Month' => $Month,
                'Year' => $Year,
                'Reference' => $Reference,
                'ClientId' => $filteredsessionclient[0]->Client->ClientId,
                'ClientTypeId' => $filteredsessionclient[0]->Client->ClientTypeId,
                'ClientName' => $ClientName,
                'ClientAddress' => $filteredsessionclient[0]->Client->Address,
                'ClientNumber' => $filteredsessionclient[0]->Client->Number,
                'ClientZipCode' => $filteredsessionclient[0]->Client->ZipCode,
                'ClientCity' => $filteredsessionclient[0]->Client->City,
            ];
            // On initialise des compteurs pour calcules les montants de la facture
            $total = 0;
            $Paid = 0;
            $nbrsession = 0;
            $SessionList = array();

            // On parcours les sessions pour calculer les informations
            foreach ($filteredsessionclient as $sessionclient) {
                ++$nbrsession;
                $Paid += $sessionclient->Paid;
                $total += $sessionclient->Price;
                $Sessioninfo['SessionId'] = $sessionclient->SessionId;
                $Sessioninfo['DateSession'] = $sessionclient->Session->DateSession;
                $Sessioninfo['Price'] = $sessionclient->Price;
                $Sessioninfo['Paid'] = $sessionclient->Paid;
                $SessionList[] = $Sessioninfo;
            }

            // On termine de construire notre tableau
            $invoice['TVA'] = (float)$total * 21 / 100;
            $invoice['HTVA'] = (float)$total - (float)$total * 21 / 100;
            $invoice['TVAC'] = (float)$total;
            $invoice['Paid'] = $Paid;
            $invoice['SessionList'] = $SessionList;

            // On l'ajoute dans le tableau global
            $invoices[] = $invoice;
        }
        // On génère une vue qui permettra de valider les factures
        $titre = 'Facturer la période aux clients';
        render('invoice.generate', compact('invoices', 'Year', 'Month', 'titre'));
    }

    /***
     * Permet de sauvegarder la facture dans la base de données.
     *  1) créer la facture et la sauvegarder
     *  2) créer les enregistrements dans la table pivot invoice_sessions qui reprend les sessions de chaqu facturee
     *  3) update les sessions des clients en ajoutant la référence de la facture dont elle dépend
     * @return void
     */
    function store()
    {
        $data = request()->postData();

        // 1. Créer l'Invoice, la sauvegarder et récupérer son Id
        $invoice = Invoice::create([
            'Reference' => $data['Reference'],
            'Month' => $data['Month'],
            'Year' => $data['Year'],
            'ClientId' => $data['ClientId'],
            'HTVA' => substr($data['HTVA'], 0, -4),
            'TVA' => substr($data['TVA'], 0, -4),
            'TVAC' => substr($data['TVAC'], 0, -4),
            'Paid' => substr($data['Paid'], 0, -4),
        ]);

        // 2. Récupérer les SessionId depuis le formulaire
        $SessionIds = explode(',', $data['SessionIdList']);

        // 3. Insérer les données dans la table pivot InvoiceSession
        foreach ($SessionIds as $SessionId) {
            InvoiceSession::create([
                'InvoiceId' => $invoice->InvoiceId,
                'SessionId' => $SessionId,
            ]);
        }

        // 4. Update la table SessionClient avec la référence de la facture
        SessionClient::where('ClientId', $data['ClientId'])
            ->whereIn('SessionId', $SessionIds)
            ->update(['Invoice' => $data['Reference']]);

        response()->redirect(route('invoices.index'));
    }

    /***
     * Permet de sauvegarder plusieurs factures dans la base de données sur base d'un json reçu en paramètre.
     *  1) créer la facture et la sauvegarder
     *  2) créer les enregistrements dans la table pivot invoice_sessions qui reprend les sessions de chaqu facturee
     *  3) update les sessions des clients en ajoutant la référence de la facture dont elle dépend
     * @return void
     */
    function storeall() {

        $invoices = json_decode($_POST['Invoices'],false);

        foreach ($invoices as $invoice) {
            // 1. Créer l'Invoice, la sauvegarder et récupérer son Id
            $newinvoice = Invoice::create([
                'Reference' => $invoice->Reference,
                'Month' => $invoice->Month,
                'Year' => $invoice->Year,
                'ClientId' => $invoice->ClientId,
                'HTVA' => $invoice->HTVA,
                'TVA' => $invoice->TVA,
                'TVAC' => $invoice->TVAC,
                'Paid' => $invoice->Paid,
            ]);

            // 2. Insérer les données dans la table pivot InvoiceSession
            foreach ($invoice->SessionList as $session) {
                InvoiceSession::create([
                    'InvoiceId' => $newinvoice->InvoiceId,
                    'SessionId' => $session->SessionId,
                ]);

                // 3. Update la table SessionClient avec la référence de la facture
                SessionClient::where('ClientId', $invoice->ClientId)
                    ->where('SessionId', $session->SessionId)
                    ->update(['Invoice' => $invoice->Reference]);
            }
        }
        response()->redirect(route('invoices.index' ,'all'));
    }

    /**
     * Supprimer une facture sur base de son Id reçu en paramètre d'un POST
     * !!! Non implémenté !!!
     * @return void
     */
    function destroy()
    {
        $InvoiceId = $_POST['InvoiceId'];
        $invoice = Invoice::findOrFail($InvoiceId);
        if ($invoice) {
            SessionClient::where('Invoice', $invoice->Reference)->update(['Invoice' => null]);
            $invoice->delete();
        }
        response()->redirect(route('invoices.index'));
    }

    /**
     * Permet de clôturer une facture.
     *  1) Encode une date de paiement (date du jour)
     *  2) Update chaque session du client concerné par la facture pour encodé le montant payé
     * @param integer $invoiceid     Paramètre qui permet de récupérer la facture à clôturer
     * @return mixed
     */
    public function paid($invoiceid)
    {
        $invoice = Invoice::where('InvoiceId', $invoiceid)->first();
        $sessionclients = SessionClient::where('Invoice', $invoice->Reference)->get();
        foreach ($sessionclients as $sessionclient) {
            $sessionclient->update(['Paid' => $sessionclient->Price]);
        }
        $invoice->update(['Paid' => $invoice->TVAC]);
        $invoice->update(['DatePaid' => Datetime::createFromFormat("Y-m-d", date('Y-m-d'))]);
        return redirect(route('invoices.details', $invoiceid))->back()->with('message', 'Méthode exécutée avec succès !');
    }

}
