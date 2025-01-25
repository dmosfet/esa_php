<?php

namespace App\Models;
class Pony extends Model {
    protected $primaryKey = 'PonyId';
    public $timestamps = false;
    protected $fillable = [
        'Name', 'DateOfBirth','Heigth','MaxWorkHour','TemperamentId',
    ];

    public function temperament()
    {
        return $this->hasOne('App\Models\Temperament', 'TemperamentId','TemperamentId');
    }
    public function SessionPony()
    {
        return $this->belongsTo(SessionPony::class,'PonyId','PonyId');
    }
}
