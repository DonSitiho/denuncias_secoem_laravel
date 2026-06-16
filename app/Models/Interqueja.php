<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interqueja extends Model
{
    use HasFactory;

     // Nombre de la tabla de la buzon naranja
    protected $table = 'interquejas';

    // Laravel asume 'id', lo cambiamos a la PK real de la tabla
    protected $primaryKey = 'id';

    protected $fillable = [
        'editar',
        'municipio_hecho_id',
        'localidad_hecho',
        'depedencia_hecho',
        'fecha_hecho',
        'nombre_serv',
        'cargo_serv',
        'area_serv',
        'carac_sexo',
        'carac_tez',
        'carac_estat',
        'carac_edad',
        'carac_complex',
        'carac_ojos',
        'carac_pelo',
        'carac_part',
        'hechos_donde',
        'hechos_cuando',
        'hechos_invol',
        'hechos_como',
        'hechos_pruebas',
        'hechos_testigos',
        'qjs_nombre',
        'qjs_dom',
        'qjs_col',
        'qjs_cp',
        'qjs_entidad_id',
        'qjs_municipio_id',
        'qjs_local',
        'qjs_tel',
        'qjs_email',
        'created_at'
    ];
}
