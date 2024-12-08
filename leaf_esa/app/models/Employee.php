<?php

namespace App\Models;

class Employee extends Model
{
    protected $table = 'employees';
    protected $primaryKey = 'EmployeeId';
    public $timestamps = false;
}
