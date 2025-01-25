<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Client extends Model {
    protected $primaryKey = 'ClientId';
    public $timestamps = false;
    protected $fillable = [
        'ClientTypeId','SocietyName','FirstName', 'LastName','DateOfBirth','BCE', 'Email', 'Telephone', 'Address', 'Number', 'ZipCode', 'City'
    ];

    public function ClientType(): HasOne
    {
        return $this->hasOne(ClientType::class,'ClientTypeId', 'ClientTypeId');
    }

    public function SessionClient()
    {
        return $this->belongsTo(SessionClient::class,'ClientId','ClientId');
    }


}
