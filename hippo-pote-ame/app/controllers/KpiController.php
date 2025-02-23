<?php

namespace App\Controllers;

use App\Models\Pony;
use App\Models\Session;
use App\Models\SessionClient;

class KpiController extends Controller
{
    /**
     * Permet de récupérer les éléments nécessaires à l'affichage d'indicateur
     * @param $type String      Paramètre qui définit le type d'indicateur à afficher:
     *  'ponies' => Utilisation des poneys dans la semaine en cours
     *  'invoices' => Sessions des clients sur le mois en cours pour calculer les montants facturés et/ou payés
     *  'session' => Sessions des clients sur le mois en cours pour calculer le taux d'occupation
     * @return void
     */
    function index($type)
    {
        $titre = 'Statistiques des ' . $type;
        switch ($type) {
            case 'ponies':
                $datas = Pony::with('Temperament', 'HourPlanned', 'HourDone')->get();
                break;
            case 'invoices':
                $datas = SessionClient::getEventsOfCurrentMonth();
                break;
            case 'sessions':
                $sessions = Session::getEventsOfCurrentMonth();
                foreach($sessions as $typesession => $session) {
                    $empty=0;
                    $totalsessions= $session->count();
                    $totalparticipants=0;
                    $totalponies=0;
                    foreach($session as $data) {
                        if ($data->sessionpony->count() == 0) {
                            $empty++;
                        } else {
                            $totalparticipants += $data->Participants;
                            $totalponies += $data->sessionpony->count();
                        }
                    }

                    if ($totalparticipants != 0)
                    {
                        $medium = $totalponies / $totalparticipants;
                    } else {
                        $medium = 0;
                    }

                    $datas[$typesession] = ['total' => $totalsessions, 'empty' => $empty, 'medium' => $medium];
                }
                break;
        }
        render('kpi.index', compact('titre', 'datas', 'type'));
    }
}
