<?php

namespace App\Models;
class Temperament extends Model {
    protected $table = 'temperament';
    protected $primaryKey = 'TemperamentId';
    public $timestamps = false;
    protected $fillable = [
        'TemperamentName'
    ];

    public function ponies() {
        return $this->hasMany('App\Models\Pony', 'TemperamentId');
    }
}
