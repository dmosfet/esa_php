<?php

namespace App\Models;
class SessionPony extends Model {
    public $timestamps = false;
    protected $fillable = [
        'PonyId','SessionId'
    ];

    public function session()
    {
        return $this->hasOne('App\Models\Session', 'SessionId','SessionId');
    }
    public function pony()
    {
        return $this->hasOne('App\Models\Pony', 'PonyId','PonyId');
    }
}
