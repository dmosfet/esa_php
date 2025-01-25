<?php

namespace App\Models;
class SessionClient extends Model {
    public $table='session_clients';
    public $timestamps = false;
    protected $fillable = [
        'ClientId', 'SessionId','Price', 'Paid'
    ];

    public function client()
    {
        return $this->hasOne(Client::class, 'ClientId', 'ClientId');
    }

    public function session()
    {
        return $this->hasOne(Session::class, 'SessionId', 'SessionId');
    }

}
