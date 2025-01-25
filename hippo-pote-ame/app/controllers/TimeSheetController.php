<?php

namespace App\Controllers;

use \App\Models\Session;
use DateTime;

class TimeSheetController extends Controller {
    function index() {
        $titre= 'Agenda';
        if (isset($_POST['today'])) {
            $today = DateTime::createFromFormat('d-m-Y', $_POST['today']);
            $firstday = DateTime::createFromFormat('d-m-Y', $_POST['today']);
            $before = DateTime::createFromFormat('d-m-Y', $_POST['today']);
            $after = DateTime::createFromFormat('d-m-Y', $_POST['today']);
        } else {
            $today = new DateTime();
            $firstday = new DateTime();
            $before = new DateTime();
            $after = new DateTime();
        }
        $firstday->modify('-' . ($today->format('N')-1) . ' days');
        $day = $firstday;
        $before->modify('-' . 7+($today->format('N')-1) . ' days');
        $after->modify('+' . 7-($today->format('N')). ' days');
        $heuredebut = DateTime::createFromFormat('H:i', '09:00');
        $heurefin = DateTime::createFromFormat('H:i', '17:00');
        $sessions = Session::all();
        render('timesheet.index',compact('sessions','titre', 'day', 'firstday','before','after', 'heuredebut', 'heurefin'));
    }
}
