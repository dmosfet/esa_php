<?php

namespace App\Models;
use DateTime;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Pony extends Model {
    protected $primaryKey = 'PonyId';
    public $timestamps = false;
    protected $fillable = [
        'Name', 'DateOfBirth','Height','MaxWorkHour','TemperamentId',
    ];

    //Gestion des relations avec Eloquent
    public function temperament(): HasOne
    {
        return $this->hasOne('App\Models\Temperament', 'TemperamentId','TemperamentId');
    }
    public function sessions(): BelongsToMany
    {
        return $this->belongsToMany(Session::class,'session_ponies','PonyId','SessionId');
    }

    // Calcul des heures de travail planifiées d'un poney dans la semaine en cours
    public function HourPlanned()
    {
        $today = new DateTime();
        $firstday = new DateTime();
        $lastday = new DateTime();
        $firstday->modify('-' . ($today->format('N')-1) . ' days');
        $lastday->modify('+' . (7-$today->format('N')) . ' days');
        return $this->hasManyThrough(Session::class, SessionPony::class, 'PonyId', 'SessionId', 'PonyId', 'SessionId')
            ->where('sessions.DateSession', '>=', $today->format('Y-m-d'))
            ->where('sessions.DateSession', '<=', $lastday->format('Y-m-d'))
            ->selectRaw('SUM(Duration) as total_hour_planned')
            ->groupBy('session_ponies.PonyId');
    }

    // Calcul des heures de travail déjà réalisées d'un poney dans la semaine en cours
    public function HourDone()
    {
        $today = new DateTime();
        $firstday = new DateTime();
        $lastday = new DateTime();
        $firstday->modify('-' . ($today->format('N')-1) . ' days');
        $lastday->modify('+' . (7-$today->format('N')) . ' days');
        return $this->hasManyThrough(Session::class, SessionPony::class, 'PonyId', 'SessionId', 'PonyId', 'SessionId')
            ->where('sessions.DateSession', '>=', $firstday->format('Y-m-d'))
            ->where('sessions.DateSession', '<', $today->format('Y-m-d'))
            ->selectRaw('SUM(Duration) as total_hour_done')
            ->groupBy('session_ponies.PonyId');
    }
}
