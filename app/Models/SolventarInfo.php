<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'fecha_solicitud',
        'is_complete',
        'is_active'

    ];

    public const TIPOCAMPO = ['date', 'text', 'archivo', 'entero'];
}
