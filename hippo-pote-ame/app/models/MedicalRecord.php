<?php

namespace App\Models;

class MedicalRecord extends Model {
    protected $primaryKey = 'RecordId';
    protected $foreignKey = 'PonyId';
    protected $fillable = [
        'Date', 'Description'
    ];

    public function pony()
    {
        return $this->hasOne('App\Models\Pony', 'Ponyid','Ponyid');
    }
}
