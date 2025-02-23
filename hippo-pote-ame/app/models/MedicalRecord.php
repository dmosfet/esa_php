<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasOne;

class MedicalRecord extends Model {
    protected $primaryKey = 'RecordId';
    protected $foreignKey = 'PonyId';
    protected $fillable = [
        'Date', 'Description'
    ];

    //Gestion des relations avec Eloquent
    public function Pony(): HasOne
    {
        return $this->hasOne('App\Models\Pony', 'PonyId','PonyId');
    }
}
