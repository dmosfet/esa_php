<?php

namespace App\Models;
class Temperament extends Model {
    protected $primaryKey = 'TemperamentId';
    public $timestamps = false;
    protected $fillable = [
        'Name', 'Description'
    ];

}
