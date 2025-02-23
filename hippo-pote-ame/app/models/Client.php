<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Client extends Model {
    protected $primaryKey = 'ClientId';
    public $timestamps = false;
    protected $fillable = [
        'ClientTypeId','SocietyName','FirstName', 'LastName','DateOfBirth','BCE', 'Email', 'Telephone', 'Address', 'Number', 'ZipCode', 'City'
    ];

    //Gestion des relations avec Eloquent
    public function ClientType(): HasOne
    {
        return $this->hasOne(ClientType::class,'ClientTypeId', 'ClientTypeId');
    }

    public function sessions(): BelongsToMany
    {
        return $this->belongsToMany(Session::class,'session_clients','ClientId','SessionId');
    }

    public function SessionClient(): BelongsTo
    {
        return $this->belongsTo(SessionClient::class,'ClientId','ClientId');
    }


}
