<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DenunciaInvolucrado extends Model
{
    protected $table = 'denuncia_involucrado';
    protected $primaryKey = 'id_involucrado';
    public $timestamps = false;

    //cuatruple chale
    protected $fillable = [
        'id_denuncia',
        'es_servidor_publico',
        'nombre_denunciado',
        'puesto_denunciado',
        'sexo',
        'tez',
        'estatura_aprox',
        'edad_aprox',
        'complexion',
        'color_ojos',
        'tipo_cabello',
        'senas_particulares',
        'descripcion_fisica',
    ];
    
    protected $casts = [
        'es_servidor_publico' => 'boolean',
    ];

    // Relación 1:N Inversa con Denuncia
    public function denuncia(): BelongsTo
    {
        return $this->belongsTo(Denuncia::class, 'id_denuncia', 'id_denuncia');
    }
}