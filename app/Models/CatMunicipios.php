<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CatMunicipios extends Model
{
    protected $table = 'cat_municipios';
    protected $primaryKey = 'id_municipio';
    public $timestamps = false;

    protected $fillable = [
        'nombre_municipio',
        'clave_municipio',
    ];

    // Relación 1:N con DenunciaCircunstancia (opcional, para ver dónde se usó)
    public function circunstancias()
    {
        return $this->hasMany(DenunciaCircunstancia::class, 'id_municipio', 'id_municipio');
    }

    // Relación 1:N con BuzonNaranjaDenuncia (opcional, para ver dónde se usó)
    public function buzonNaranja() 
    {
        return $this->hasMany(BuzonNarajaDenuncia::class, 'id_municipio', 'id_municipio');
    }

}