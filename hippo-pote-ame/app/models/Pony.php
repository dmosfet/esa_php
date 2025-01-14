<?php

namespace App\Models;
class Pony extends Model {
    protected $table = 'pony';
    protected $primaryKey = 'PonyId';
    public $timestamps = false;
    protected $fillable = [
        'PonyName', 'PonyMaxWorkHour','PonyTemperamentId',
    ];

    public function temperament()
    {
        return $this->hasOne('App\Models\Temperament', 'TemperamentId','PonyTemperamentId');
    }
}
