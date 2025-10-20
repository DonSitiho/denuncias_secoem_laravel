<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DatosContactoDenunciante extends Model
{
    protected $table = 'datos_contacto_denunciante';
    protected $primaryKey = 'id_contacto';
    public $timestamps = false;

    // Relación 1:1 Inversa con Denuncia
    public function denuncia(): BelongsTo
    {
        return $this->belongsTo(Denuncia::class, 'id_denuncia', 'id_denuncia');
    }
}