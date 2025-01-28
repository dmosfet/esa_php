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
        $datejour = DateTime::createFromFormat('Y-m-d', date('Y-m-d'));
        $heurejour = DateTime::createFromFormat('H:i:s', date('H:i:s'));
        $datesession= DateTime::createFromFormat('Y-m-d', $this->DateSession);
        $heuredebutsession = DateTime::createFromFormat('H:i:s', $this->HourSession);
        $heurefinsession = Datetime::createFromFormat('H:i:s',$this->HourSession);
        $heurefinsession->modify('+' . $this->Duration . ' minutes');
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
