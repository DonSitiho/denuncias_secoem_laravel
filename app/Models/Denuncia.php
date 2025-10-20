<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Denuncia extends Model
{
    // Nombre de la tabla de la denuncia
    protected $table = 'denuncia';

    // Laravel asume 'id', lo cambiamos a la PK real de la tabla
    protected $primaryKey = 'id_denuncia';

    // Deshabilitamos timestamps (created_at, updated_at) si no se usan
    public $timestamps = false; 

    // Relación 1:1 con los metadatos de seguimiento (doc_denuncias)
    // Esta parte se integrará al dar seguimiento a la denuncia (fase administrativa)
    // Clave local: id_denuncia, Clave foránea: id_denuncia
    // public function seguimiento(): HasOne
    // {
    //     return $this->hasOne(DocDenuncias::class, 'id_denuncia', 'id_denuncia');
    // } Todavía no se crea la tabla doc_denuncias

    // Relación 1:1 con la Circunstancia (ubicación, fechas)
    public function circunstancia(): HasOne
    {
        return $this->hasOne(DenunciaCircunstancia::class, 'id_denuncia', 'id_denuncia');
    }

    // Relación 1:1 con los datos de contacto del denunciante
    public function contacto(): HasOne
    {
        return $this->hasOne(DatosContactoDenunciante::class, 'id_denuncia', 'id_denuncia');
    }

    // Relación 1:N con los archivos/evidencia
    public function archivos(): HasMany
    {
        return $this->hasMany(ArchivoAdjunto::class, 'id_denuncia', 'id_denuncia');
    }

    // Relación 1:N con los involucrados
    public function involucrados(): HasMany
    {
        return $this->hasMany(DenunciaInvolucrado::class, 'id_denuncia', 'id_denuncia');
    }

    // Relación 1:N con los testigos
    public function testigos(): HasMany
    {
        return $this->hasMany(DenunciaTestigo::class, 'id_denuncia', 'id_denuncia');
    }
}