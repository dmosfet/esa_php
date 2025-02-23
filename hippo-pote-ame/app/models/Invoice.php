<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Invoice extends Model {
    protected $primaryKey = 'InvoiceId';
    protected $foreignKey = 'ClientId';
    protected $fillable = [
        'Reference', 'Month','Year', 'ClientId','HTVA','TVA','TVAC','Paid','DatePaid'
    ];

    //Gestion des relations avec Eloquent
    public function client(): HasOne
    {
        return $this->hasOne('App\Models\Client', 'ClientId','ClientId');
    }

    public function session(): HasMany
    {
        return $this->hasMany('App\Models\InvoiceSession', 'SessionId','SessionId');
    }

}
