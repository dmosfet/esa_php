<?php

namespace App\Controllers;

use App\Models\Session;
use App\Models\SessionClient;
use App\Models\SessionPony;
use App\Models\SessionType;
use DateInterval;
use DateTime;

class SessionController extends Controller
{
    /**
     * Prépare l'affichage de la liste des sessions organisées. Cet affichage peut-être filtré sur base d'un paramètre
     *
     * @param String $type Paramètre qui définit le filtre à appliquer sur l'affichage des sessions:
     *  'groups' => les sessions qui concernent les activités de groupes
     *  'private' => les sessions qui concernant les cours collectifs
     *  'birthday' => les sessions qui concernent les anniversaires
     *  'all' => toutes les sessions
     *  'today' => toutes les sessions du jour
     * @return void
     */
    function index($type = null)
    {
        $page = $_GET['page'] ?? 1;
        $parPage = 5;
        $titre = 'Liste des Sessions';
        if ($type == 'groups') {
            $sessions = Session::with('SessionType')
                ->where('SessionTypeId', 1)
                ->orderBy('DateSession', 'DESC')
                ->paginate($parPage, ['*'], 'page', $page)
                ->withPath('/groups/sessions');
        } elseif ($type == 'private') {
            $sessions = Session::with('SessionType')
                ->where('SessionTypeId', 2)
                ->orderBy('DateSession', 'DESC')
                ->paginate($parPage, ['*'], 'page', $page)
                ->withPath('/private/sessions');
        } elseif ($type == 'all') {
            $sessions = Session::with('SessionType')
                ->orderBy('DateSession', 'DESC')
                ->paginate($parPage, ['*'], 'page', $page)
                ->withPath('/all/sessions');
        } elseif ($type == 'today') {
            $sessions = Session::with('SessionType')
                ->where('DateSession', date('Y-m-d'))
                ->orderBy('DateSession', 'DESC')
                ->paginate($parPage, ['*'], 'page', $page)
                ->withPath('/all/sessions');
        } elseif ($type == 'birthday') {
            $sessions = Session::with('SessionType')
                ->where('SessionTypeId', 3)
                ->orderBy('DateSession', 'DESC')
                ->paginate($parPage, ['*'], 'page', $page)
                ->withPath('/birthday/sessions');
        } else {
            $sessions = Session::with('SessionType')
                ->orderBy('DateSession', 'ASC')
                ->get();
        }
        render('session.index', compact('sessions', 'titre'));
    }

    /**
     * Permet de récupérer les informations qui génère une vue détaille de la session
     * @param int $SessionId    Paramètre qui identifie la session à afficher
     * @return void
     */
    function details(int $SessionId)
    {
        $titre = "Fiche Session";
        $session = Session::where('SessionId', $SessionId)->with('SessionType')->first();
        $sessionclients = SessionClient::with('client')->where('SessionId', $SessionId)->get();
        $sessionponies = SessionPony::with('pony')->where('SessionId', $SessionId)->get();
        render('session.details', compact('session', 'sessionclients', 'sessionponies', 'titre', 'SessionId'));
    }

    /**
     * Permet de générer un formulaire de modification d'une session
     * @return void
     */
    function edit()
    {
        $SessionId = $_POST['SessionId'];
        $titre = 'Modifier une session';
        $session = Session::where('SessionId', $SessionId)->first();
        render('session.edit', compact('session', 'titre'));
    }

    /**
     * Update d'une session modifiée sur base d'un formulaire POST
     * @return void
     */
    function update()
    {
        $data = request()->postData();
        $session = Session::find($data['SessionId']);
        $session->DateSession = $data['DateSession'];
        $session->HourSession = $data['HourSession'];
        $session->Duration = $data['Duration'];
        $session->Participants = $data['Participants'];
        $session->save();
        response()->redirect(route('sessions.details', $data['SessionId']));
    }

    /**
     * Permet de préparer le formulaire de création d'une Session
     * @return void
     */
    function create()
    {
        $session = new Session();
        $titre = 'Créer une nouvelle session';
        $sessiontypes = SessionType::orderBy('SessionTypeId', 'ASC')->get();
        render('session.create', compact('session', 'sessiontypes', 'titre'));
    }

    /**
     * Permet d'enregistrer une nouvelle session sur base des informations reçues d'un formularie
     * @return void
     */
    function store()
    {
        $data = request()->postData();

        // Vérification que la session a bien lieu pendant les heures d'ouvertures
        $errors = [];
        $date = DateTime::createFromFormat('Y-m-d', $data['DateSession']);
        $heuremin = DateTime::createFromFormat('H:i', '09:00');
        $heuremax = DateTime::createFromFormat('H:i', '17:00');
        $heuredebut = DateTime::createFromFormat('H:i', $data['HourSession']);;
        $heurefin = DateTime::createFromFormat('H:i', $data['HourSession']);
        $heurefin->add(DateInterval::createFromDateString($data['Duration'] . ' hour'));

        // vérifie si ce n'est pas un dimanche
        if ($date->format('N') > "6") {
            array_push($errors, 'La séance se déroule en dehors des jours d\'ouverture.');
        } else {
            // vérifie les heures de début et de fin de la session
            if ($heurefin > $heuremax) {
                array_push($errors, 'La séance se termine en dehors des heures d\'ouverture.');
            }
            if ($heuredebut < $heuremin || $heuredebut > $heuremax) {
                array_push($errors, 'La séance débute en dehors des heures d\'ouverture.');
            }
        }

        //vérifie qu'il n'existe pas une séance programée pour cette plage
        $sessions = Session::where('DateSession', $data['DateSession'])->get();
        if ($sessions->isNotEmpty()) {
            foreach ($sessions as $session) {
                $verifheuredebut = DateTime::createFromFormat('H:i:s', $session->HourSession);;
                $verifheurefin = DateTime::createFromFormat('H:i:s', $session->HourSession);
                $verifheurefin->add(DateInterval::createFromDateString($session->Duration . ' hour'));
                if ($heuredebut == $verifheuredebut) {
                    array_push($errors, 'La piste n\'est pas disponible pour les heures demandées.');
                } elseif ($heurefin == $verifheurefin) {
                    array_push($errors, 'La piste n\'est pas disponible pour les heures demandées.');
                } elseif ($heuredebut > $verifheuredebut && $heuredebut < $verifheurefin) {
                    array_push($errors, 'La piste n\'est pas disponible pour les heures demandées.');
                }
            }
        }
        // Si erreurs, on renvoie les erreurs et on regénère un nouveau formulaire
        // Si pas d'erreurs, on créé la fiche et on ouvre pour éventuellement procéder à l'insription d'un ou plusieurs
        // clients et à l'attribution de poneys
        if ($errors) {
            $titre = 'Créer une nouvelle session';
            $sessiontypes = SessionType::all();
            $session = new Session(request()->postData());
            render('session.create', compact('errors', 'session', 'sessiontypes', 'titre'));
        } else {
            $session = Session::create(request()->postData());
            $titre = "Fiche Session";
            $SessionId = $session['SessionId'];
            $sessionclients = SessionClient::with('client')->where('SessionId', $SessionId)->get();
            $sessionponies = SessionPony::with('pony')->where('SessionId', $SessionId)->get();
            render('session.details', compact('session', 'sessionclients', 'sessionponies', 'titre', 'SessionId'));
        }
    }

    /**
     * Supprimer une session sur base de son ID transmis par un formulaire POST
     * @return void
     */
    function destroy()
    {
        $id = (int)$_POST['SessionId'];
        $session = Session::findOrFail($id);
        if ($session) {
            $session->delete();
        }
        response()->redirect(route('sessions.index', 'today'));
    }
}
