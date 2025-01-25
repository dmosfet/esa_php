<?php

namespace App\Models;
class ClientType extends Model
{
    protected $primaryKey = 'ClientTypeId';
    public $timestamps = false;
    protected $fillable = [
        'Name'
    ];
}
