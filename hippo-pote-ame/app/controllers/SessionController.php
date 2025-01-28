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

    function index($type=null)
    {
        $titre = 'Liste des Sessions';
        if ($type == 'groups') {
            $sessions = Session::with('SessionType')
                ->where('SessionTypeId', 1)
                ->orderBy('DateSession', 'ASC')
                ->get();
        } elseif ($type == 'private') {
            $sessions = Session::with('SessionType')
                ->where('SessionTypeId', 2)
                ->orderBy('DateSession', 'ASC')
                ->get();
        } elseif ($type == 'all') {
            $sessions = Session::with('SessionType')
                ->orderBy('DateSession', 'ASC')
                ->get();
        } elseif ($type == 'today') {
            $sessions = Session::with('SessionType')
                ->where('DateSession', date('Y-m-d'))
                ->orderBy('DateSession', 'ASC')
                ->get();
        } else {
            $sessions = Session::with('SessionType')
                ->orderBy('DateSession', 'ASC')
                ->get();
        }
        render('session.index', compact('sessions', 'titre'));
    }

    function details(int $SessionId)
    {
        $titre = "Fiche Session";
        $session = Session::where('SessionId', $SessionId)->first();
        $sessionclients = SessionClient::with('client')->where('SessionId', $SessionId)->get();
        $sessionponies = SessionPony::with('pony')->where('SessionId', $SessionId)->get();
        render('session.details', compact('session', 'sessionclients','sessionponies','titre', 'SessionId',));
    }

    function edit()
    {
        $SessionId = $_POST['SessionId'];
        $titre = 'Modifier une session';
        $session = Session::where('SessionId', $SessionId)->first();
        render('session.edit', compact('session', 'titre',));
    }

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

    function create()
    {
        $session = new Session();
        $titre = 'Créer une nouvelle session';
        $sessiontypes = SessionType::all();
        render('session.create', compact('session', 'sessiontypes', 'titre'));
    }

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
            array_push($errors, 'La séance se déroule en dehors des jours d\'ouvertures');
        } else {
            // vérifie les heures de début et de fin de la session
            if ($heurefin > $heuremax) {
                array_push($errors, 'La séance se termine en dehors des heures d\'ouvertures');
            }
            if ($heuredebut < $heuremin || $heuredebut > $heuremax) {
                array_push($errors, 'La séance débute en dehors des heures d\'ouvertures');
            }
        }
        if ($errors) {
            $titre = 'Créer une nouvelle session';
            $sessiontypes = SessionType::all();
            $session = new Session(request()->postData());
            render('session.create',compact('errors', 'session', 'sessiontypes','titre'));
        } else {
            $session = new Session();
            $session->SessionTypeId = $data['SessionTypeId'];
            $session->DateSession = $data['DateSession'];
            $session->HourSession = $data['HourSession'];
            $session->Duration = $data['Duration'];
            $session->Participants = $data['Participants'];
            $session->save();
            response()->redirect(route('sessions.index'),'');
        }


    }
    function destroy()
    {
        $id = (int)$_POST['SessionId'];
        $session= Session::findOrFail($id);
        if ($session) {
            $session->delete();
        }
        response()->redirect(route('sessions.index'));
    }
}
