<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SolventarInfo extends Model
{
    use HasFactory;

    // Nombre de la tabla de la denuncia
    protected $table = 'solventar_info';

    // Deshabilitamos timestamps (created_at, updated_at) si no se usan
    public $timestamps = false;

    protected $fillable = [
        'id_denuncia',
        'id_usuario_solicito',
        'id_area_responsable',
        'observacion_responsable',
        'tipo_campo',
        'info_solicitada',
        'fecha_solicitud_info',
        'fecha_respuesta_info',
        'is_complete',
        'is_active'
    ];

    protected $casts = [
        'fecha_solicitud_info' => 'date',
        'fecha_respuesta_info' => 'datetime',
    ];

    public const TIPOCAMPO = ['date', 'text', 'archivo', 'entero'];

    /**
     * Accessor para info_solicitada
     * Si tipo_campo es "archivo", decodifica el JSON.
     * 
     */
    public function getInfoSolicitadaAttribute($value)
    {
        if ($this->tipo_campo === 'archivo' && $value) {
            return json_decode($value);
        }

        return $value;
    }

    // Relacion 1:N  Inversa con Denuncia
    public function denuncia(): BelongsTo
    {
        return $this->belongsTo(Denuncia::class, 'id_denuncia', 'id_denuncia');
    }
}
