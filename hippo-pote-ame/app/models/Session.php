<?php

namespace App\Models;
use DateTime;

class Session extends Model {
    protected $primaryKey = 'SessionId';
    public $timestamps = false;
    protected $fillable = [
        'SessionTypeId','DateSession', 'HourSession','Duration', 'Participants',
    ];

    public function SessionType()
    {
        return $this->hasOne('App\Models\SessionType', 'SessionTypeId', 'SessionTypeId');
    }

    public function SessionClient()
    {
        return $this->hasMany('App\Models\SessionClient', 'SessionId');
    }

    public function SessionPony()
    {
        return $this->hasMany('App\Models\SessionPony', 'SessionId');
    }

    public function Statut()
    {
        $datesession = date('d/m/Y', strtotime($this->DateSession));
        $datejour = date('d/m/Y');
        $heurejour = date('H:i:s');
        $heuredebutsession = date('H:i:s', strtotime($this->HourSession));
        $finsession = new Datetime($this->HourSession);
        $finsession->modify('+' . $this->Duration . ' minutes');
        $heurefinsession = date_format($finsession, 'H:i:s');

        if ($datesession > $datejour) {
            $statut = "Non-démarrée";
        } elseif ($datesession == $datejour) {
            if ($heuredebutsession > $heurejour) {
                $statut = "Non-démarrée";
            } elseif ($heurefinsession > $heurejour) {
                $statut = "En cours";
            } else {
                $statut = "Terminée";
            }
        } else {
            $statut = "Terminée";
        }
        return $statut;
    }
}
