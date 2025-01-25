<?php

namespace App\Models;
class Invoice extends Model {
    protected $primaryKey = 'InvoiceId';
    protected $foreignKey = 'ClientId';
    protected $fillable = [
        'Reference', 'Month','Year','DatePaid'
    ];

    public function client()
    {
        return $this->hasOne('App\Models\Client', 'ClientId','ClientId');
    }
}
