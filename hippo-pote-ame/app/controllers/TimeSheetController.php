<?php

namespace App\Controllers;

use App\Models\Session;
use App\Models\SessionType;
use DateTime;

class TimeSheetController extends Controller
{

    /**
     * Permet de préparer les éléments pour afficher l'agenda en fonction du mode sélectionné
     * @param String $mode Paramètre qui détermine le filtre qui sera utilisé pour afficher l'agenda
     *  'today' => L'agenda du jour
     *  'week' => L'agenda de la semaine
     * @return void
     *
     */
    function index($mode = null)
    {
        $titre = 'Agenda';
        // On récupère éventuellement une date passée d'un formulaire POST qui permet de créer une navigation de jour
        // en jour ou de semaine en semaine. A défaut, ce sera la date du jour.
        $day = isset($_POST['day']) ? Datetime::createFromFormat('Y-m-d', $_POST['day']) : new DateTime();

        // On prépare l'array jour[] qui sera retournée dans la vue. Elle contiendra un ou plusieurs array jour[].
        $jours = [];

        // Si on est en mode 'week' alors la variable day deviendra le lundi de la semaine en cours. On initialise un compteur de jours
        if ($mode == 'today') {
            $nbrjour = 1;
        } else {
            $nbrjour = 7;
            $day->modify('-' . ($day->format('N') - 1) . ' days');
        }
        // On initialise 2 valeurs qui seront utilisées pour soit générer la clef du tableau associatif jours[], soit servira de filtre pour la requête
        $daycolumn = clone($day);
        $daysession = clone($day);

        // Je créé une array des heures de cours du jour que j'initialise avec des + et que j'enregistre dans jour[].
        for ($i = 1; $i <= $nbrjour; $i++) {
            $jour = [];
            for ($heure = 9; $heure <= 17; $heure++) {
                $horaire = sprintf("%02d:00", $heure);
                $jour[] = ['Heure' => $horaire, 'Session' => '+', 'Type' => '', 'Duree' => 1];
            }
            $jours[$daycolumn->format('d-m-Y')] = $jour;
            $daycolumn->modify('+1 day');
        }

        // On vérifie pour chaque jour que je dois afficher s'il existe une session organisée
        for ($i = 0; $i < $nbrjour; $i++) {

            // Je récupère les sessions organisées pour l'agenda du jour à afficher
            $sessionsdujour = Session::with('SessionType')
                ->where('DateSession', $day->format('Y-m-d'))
                ->get();

            // Si pas de session, on passe au jour suivant
            if ($sessionsdujour->isEmpty()) {
                $day->modify('+1 day');
            } else {
                // Si non, on encode l'heure correspond à la session organisée dans l'agenda du jour à afficher.
                foreach ($sessionsdujour as $session) {
                    $heure = new DateTime($session->HourSession);
                    // Chercher si il existe une session a l'heure de début
                    for ($j = 1; $j <= $session->Duration; $j++) {
                        $trouve = array_filter($jours[$daysession->format('d-m-Y')], fn($item) => $item["Heure"] === $heure->format('H:i'));
                        // Si l'élément est trouvé, modifier la Session
                        if (!empty($trouve)) {
                            $index = key($trouve); // On récupère l'index de l'élément trouvé
                            $jours[$daysession->format('d-m-Y')][$index]['Session'] = $session->SessionId;
                            $jours[$daysession->format('d-m-Y')][$index]['Type'] = $session->SessionType->Name;
                            $jours[$daysession->format('d-m-Y')][$index]['Duree'] = $session->Duration;
                        }
                        $heure->modify('+ 1 hours');
                    }
                }
                $day->modify('+1 day');
            }
            $daysession->modify('+1 day');
        }

        // On prépare les données pour le formulaire de création rapide de session ainsi que les dates utilisées par
        // la barre de navigation dans l'agenda
        $sessiontypes = SessionType::all();
        if ($mode == 'week') {
            $after = clone($day);
            $day->modify('-' . ($day->format('N')-1) . ' days');
            $day->modify('-7 day');
            $before = clone($day);
            $before->modify('-7 day');
        } else {
            $before = clone($day);
            $before->modify('-2 day');
            $after = clone($day);
            $day->modify('-1 day');

        }
        render('timesheet.index', compact('titre', 'jours', 'sessiontypes', 'day', 'mode', 'before', 'after'));
    }

}
