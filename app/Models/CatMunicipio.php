<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CatMunicipio extends Model
{
    protected $table = 'cat_municipios';
    protected $primaryKey = 'id_municipio';
    public $timestamps = false;

    protected $fillable = [
        'nombre_municipio',
        'clave_municipio',
        'is_active'
    ];
}
