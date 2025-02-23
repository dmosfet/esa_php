<?php

namespace App\Models;
use Carbon\Carbon;
use DateTime;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Session extends Model {
    protected $primaryKey = 'SessionId';
    public $timestamps = false;
    protected $fillable = [
        'SessionTypeId','DateSession', 'HourSession','Duration', 'Participants',
    ];

    //Gestion des relations avec Eloquent
    public function sessiontype(): HasOne
    {
        return $this->hasOne('App\Models\SessionType', 'SessionTypeId', 'SessionTypeId');
    }

    public function sessionclient(): HasMany
    {
        return $this->hasMany('App\Models\SessionClient', 'SessionId');
    }

    public function sessionpony(): HasMany
    {
        return $this->hasMany('App\Models\SessionPony', 'SessionId');
    }

    // Calcul du statu de la session:
    //      'Non démarée' => la session n'a pas encore commencée
    //      'En cours' => la session est en cours
    //      'Terminée' => la session en terminée
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

    // Permet de récupérer toutes les sessions qui ont eu lieu dans le mois en cours
    // Les sessions sont triées par typ de session: groupe, cours, anniversaire
    public static function getEventsOfCurrentMonth()
    {
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        return [
            'groupe' => self::with('sessionpony','sessionclient')
                ->whereBetween('DateSession', [$startOfMonth, $endOfMonth])
                ->where('SessionTypeId', 1)
                ->get(),
            'cours' => self::with('sessionpony','sessionclient')
                ->whereBetween('DateSession', [$startOfMonth, $endOfMonth])
                ->where('SessionTypeId', 2)
                ->get(),
            'anniversaire' => self::with('sessionpony','sessionclient')
                ->whereBetween('DateSession', [$startOfMonth, $endOfMonth])
                ->where('SessionTypeId', 3)
                ->get(),
        ];
    }
}
