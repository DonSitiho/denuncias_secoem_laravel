<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ArchivoAdjunto extends Model
{
    protected $table = 'archivo_adjunto';
    protected $primaryKey = 'id_archivo';
    public $timestamps = false;
    public $incrementing = true;
    //fffff
    protected $fillable = [
        'id_denuncia',
        'nombre_original',
        'ruta_cifrada',
        'tipo_archivo',
        'fecha_carga',
    ];

    protected $casts = [
        'fecha_carga' => 'datetime',
    ];

    // Relación 1:N Inversa con Denuncia
    public function denuncia(): BelongsTo
    {
        return $this->belongsTo(Denuncia::class, 'id_denuncia', 'id_denuncia');
    }
}