<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuzonNarajaDenuncia extends Model
{
    use HasFactory;

    // Nombre de la tabla de la buzon naranja
    protected $table = 'buzon_naranja';

    // Laravel asume 'id', lo cambiamos a la PK real de la tabla
    protected $primaryKey = 'id';

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


}
