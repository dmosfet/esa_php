<?php

namespace App\Controllers;

use App\Models\Session;
use App\Models\SessionType;
use DateTime;

class TimeSheetController extends Controller {
    function index($mode=null) {
        $titre= 'Agenda';
        switch($mode){
            case('today');
                $number=1;
            break;
            case('week');
                $number=7;
            break;
        }
        if (isset($_POST['today'])) {
            $today = date_create_from_format('d-m-Y', $_POST['today']);
            $firstday = $today;
        } else {
            $today = new DateTime();
            $firstday = new DateTime();
        }
        $after = new DateTime();

        if ($mode!='today') {
            $firstday->modify('-' . ($today->format('N')-1) . ' days');
        }
        $day = $firstday;
        $after->modify('+' . $number-($today->format('N')). ' days');
        $heuredebut = DateTime::createFromFormat('H:i', '09:00');
        $heurefin = DateTime::createFromFormat('H:i', '17:00');
        $sessiontypes = SessionType::all();
        $sessions = Session::all();
        render('timesheet.index',compact('sessions','titre', 'number', 'day', 'mode', 'firstday','after', 'sessiontypes','heuredebut', 'heurefin'));
    }
}
