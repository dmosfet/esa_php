<?php

namespace App\Models;
class Client extends Model {
    protected $table = 'client';
    protected $primaryKey = 'ClientId';
    public $timestamps = false;
    protected $fillable = [
        'ClientName', 'ClientBCE', 'ClientEmail', 'ClientAddress', 'ClientNumber', 'ClientCP', 'ClientCity'
    ];
}
