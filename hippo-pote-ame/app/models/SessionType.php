<?php

namespace App\Models;
class SessionType extends Model
{
    protected $primaryKey = 'SessionTypeId';
    public $timestamps = false;
    protected $fillable = [
        'Name'
    ];
}
