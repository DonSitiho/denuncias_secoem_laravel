<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DenunciaCircunstancia extends Model
{
    protected $table = 'denuncia_circunstancia';
    protected $primaryKey = 'id_circunstancia';
    public $timestamps = false; 

    protected $casts = [
        'fecha_hechos' => 'date',
    ];

    // Relación 1:1 Inversa con Denuncia
    public function denuncia(): BelongsTo
    {
        return $this->belongsTo(Denuncia::class, 'id_denuncia', 'id_denuncia');
    }

    // Relación 1:1 con el Catálogo de Municipios
    public function municipio(): BelongsTo
    {
        // Une id_municipio (FK local) con id_municipio (PK externa) en la tabla 'cat_municipios'
        return $this->belongsTo(CatMunicipios::class, 'id_municipio', 'id_municipio');
    }
}