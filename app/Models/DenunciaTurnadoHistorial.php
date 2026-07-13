<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DenunciaTurnadoHistorial extends Model
{
    // Nombre de la tabla de la denuncia
    protected $table = 'denuncia_turnado_historial';
    protected $primaryKey = 'id_turnado';
    public $timestamps = false;
    
    protected $fillable = [
        'id_denuncia',
        'id_area_origen',
        'id_area_destino',
        'id_responsable'
    ];

    protected $casts = [
        'fecha_turnado' => 'date',
    ];

    // Relacion 1:N  Inversa con Denuncia
    public function denuncia(): BelongsTo
    {
        return $this->belongsTo(Denuncia::class, 'id_denuncia', 'id_denuncia');
    }


}
