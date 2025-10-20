<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DenunciaTestigo extends Model
{
    protected $table = 'denuncia_testigo';
    protected $primaryKey = 'id_testigo';
    public $timestamps = false;

    protected $casts = [
        'tiene_testigos' => 'boolean',
    ];

    // Relación 1:N Inversa con Denuncia
    public function denuncia(): BelongsTo
    {
        return $this->belongsTo(Denuncia::class, 'id_denuncia', 'id_denuncia');
    }
}