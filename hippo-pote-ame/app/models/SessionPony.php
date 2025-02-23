<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\HasOne;

class SessionPony extends Model {
    public $timestamps = false;
    protected $fillable = [
        'PonyId','SessionId'
    ];

    //Gestion des relations avec Eloquent
    public function session(): HasOne
    {
        return $this->hasOne('App\Models\Session', 'SessionId','SessionId');
    }
    public function pony(): HasOne
    {
        return $this->hasOne('App\Models\Pony', 'PonyId','PonyId');
    }
}
