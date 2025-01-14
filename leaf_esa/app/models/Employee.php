<?php

namespace App\Models;

class Employee extends Model
{
    protected $table = 'employees';
    protected $primaryKey = 'EmployeeId';
    public $timestamps = false;
    protected $fillable = [
        'FirstName',
        'LastName',
        'Title',
        'Country',
        'BirthDate'
    ];
}
