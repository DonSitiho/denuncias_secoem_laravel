<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DenunciaInvolucrado extends Model
{
    protected $table = 'denuncia_involucrado';
    protected $primaryKey = 'id_involucrado';
    public $timestamps = false;
    
    protected $casts = [
        'es_servidor_publico' => 'boolean',
    ];

    // Relación 1:N Inversa con Denuncia
    public function denuncia(): BelongsTo
    {
        return $this->belongsTo(Denuncia::class, 'id_denuncia', 'id_denuncia');
    }
}