<?php

namespace App\Models;

class Customer extends Model
{
    protected $table = 'customers';
    protected $primaryKey = 'CustomerId';
    public $timestamps = false;
}
