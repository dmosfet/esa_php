<?php

namespace App\Models;
class SessionClient extends Model {
    protected $primaryKey = null;
    public $table='session_clients';
    public $timestamps = false;
    protected $fillable = [
        'ClientId', 'SessionId','Price', 'Invoice','Paid'
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
