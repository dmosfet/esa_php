<?php

namespace App\Models;
class InvoiceSession extends Model {
    protected $primaryKey = null;
    public $timestamps = false;
    protected $fillable = [
        'InvoiceId', 'SessionId'
    ];

    //Gestion d'un modèle qui utiliser une clef composite comme clef primaire
    public function setKeysForSaveQuery($query)
    {
        return $query->where('SessionId', $this->getAttribute('SessionId'))
            ->where('InvoiceReference', $this->getAttribute('InvoiceReference'));
    }

    public function getIncrementing()
    {
        return false;
    }

    public function getKeyName()
    {
        return null;
    }

}
