<?php

namespace App\Models;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\HasOne;

class SessionClient extends Model {
    protected $primaryKey = null;
    public $table='session_clients';
    public $timestamps = false;
    protected $fillable = [
        'SessionId', 'ClientId','Price', 'Paid', 'Invoice'
    ];

    // Gestion d'un modèle a clef primaire composite
    public function setKeysForSaveQuery($query)
    {
        return $query->where('SessionId', $this->getAttribute('SessionId'))
            ->where('ClientId', $this->getAttribute('ClientId'));
    }

    public function getIncrementing()
    {
        return false;
    }

    public function getKeyName()
    {
        return null;
    }

    //Gestion des relations avec Eloquent
    public function client(): HasOne
    {
        return $this->hasOne(Client::class, 'ClientId', 'ClientId');
    }

    public function session(): HasOne
    {
        return $this->hasOne(Session::class, 'SessionId', 'SessionId');
    }

    // Récupère les événements du mois en cours.
    // Elles sont réparties dans un tableau à 2 entrées:
    // les sessions qui ont été facturées et les sessions qui ont été payées.
    public static function getEventsOfCurrentMonth()
    {
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        return [
            'factures_payes' => self::with('Session')
                ->whereHas('session', function ($query) use ($startOfMonth, $endOfMonth) {
                    $query->whereBetween('DateSession', [$startOfMonth, $endOfMonth]);})
                ->where('Invoice', '!=', 'NF')
                ->where('Paid', '>', '0')
                ->sum('Price'),

            'factures_non_payes' => self::with('Session')
                ->whereHas('session', function ($query) use ($startOfMonth, $endOfMonth) {
                    $query->whereBetween('DateSession', [$startOfMonth, $endOfMonth]);})
                ->where('Invoice', '!=', 'NF')
                ->where('Paid', '=', '0')
                ->sum('Price'),

            'non_factures_payes' => self::with('Session')
                ->whereHas('session', function ($query) use ($startOfMonth, $endOfMonth) {
                    $query->whereBetween('DateSession', [$startOfMonth, $endOfMonth]);})
                ->where('Invoice', '=', 'NF')
                ->where('Paid', '>', '0')
                ->sum('Price'),

            'non_factures_non_payes' => self::with('Session')
                ->whereHas('session', function ($query) use ($startOfMonth, $endOfMonth) {
                    $query->whereBetween('DateSession', [$startOfMonth, $endOfMonth]);})
                ->where('Invoice', '=', 'NF')
                ->where('Paid', '=', '0')
                ->sum('Price'),
        ];
    }
}
