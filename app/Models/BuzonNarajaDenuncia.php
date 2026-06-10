<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BuzonNarajaDenuncia extends Model
{
    use HasFactory;

    // Nombre de la tabla de la buzon naranja
    protected $table = 'buzon_naranja';

    // Laravel asume 'id', lo cambiamos a la PK real de la tabla
    protected $primaryKey = 'id';
    public $timestamps = false; 

    protected $fillable = [
        'folio',
        'date',
        'hora',
        'id_municipio',
        'dependencia',
        'localidad',
        'tramite',
        'narracion',
        'url_file',
        'cantidad',
        'programa',
        'denunciados',
        'cargos',
        'name',
        'lastname_p',
        'lastname_m',
        'street',
        'number',
        'colonia',
        'code',
        'sexo',
        'edad',
        'escolaridad',
        'ocupacion',
        'phone',
        'email',
        'status',
    ];

    // Relación 1:1 con el Catálogo de Municipios
    public function municipio(): BelongsTo
    {
        // Une id_municipio (FK local) con id_municipio (PK externa) en la tabla 'cat_municipios
        return $this->belongsTo(CatMunicipios::class, 'id_municipio', 'id_municipio');
    }


}
