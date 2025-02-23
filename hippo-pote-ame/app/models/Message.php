<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Message extends Model {
    protected $primaryKey = 'MessageId';
    protected $foreignKey = ['Sender', 'Receiver'];
    protected $fillable = [
        'Object','Message','Sender','Receiver','Read'
    ];

    //Gestion des relations avec Eloquent
    public function sender(): HasOne
    {
        return $this->hasOne('App\Models\User', 'username','Sender');
    }

    public function receiver(): HasOne
    {
        return $this->hasOne('App\Models\User', 'username','Receiver');
    }

}
