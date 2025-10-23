<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

class Denuncia extends Model
{
    // Nombre de la tabla de la denuncia
    protected $table = 'denuncia';

    // Laravel asume 'id', lo cambiamos a la PK real de la tabla
    protected $primaryKey = 'id_denuncia';

    // Deshabilitamos timestamps (created_at, updated_at) si no se usan
    public $timestamps = false; 

    //chaleeee
     protected $fillable = [
        'folio_seguimiento',
        'es_anonima',
        'fecha_recepcion',
        'motivo_denuncia',
        'programa_publico',
        'dinero_solicitado',
        'id_estado',
        'no_expediente_inter',
        'id_dependencia_denunciada',
        'id_area_responsable',
        'id_responsable',
        'token_validacion',
        'fecha_cierre',
        'id_denunciante',
    ];

    protected $casts = [
        'es_anonima' => 'boolean',
        'fecha_recepcion' => 'datetime',
        'dinero_solicitado' => 'decimal:2',
        'fecha_cierre' => 'datetime',
    ];

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

    // Relaciones para turnado y cambio de estado
    /**
     * Relación N:1 con el Catálogo de Estados (cat_estados).
     */
    public function estado(): BelongsTo
    {
        // Asume que la FK es 'id_estado' en la tabla 'denuncia'
        return $this->belongsTo(CatEstados::class, 'id_estado', 'id_estado');
    }
    
    /**
     * Relación N:1 con el Área Responsable (areas).
     */
    public function areaResponsable(): BelongsTo
    {
        // Une denuncia.id_area_responsable con areas.id_area
        return $this->belongsTo(Area::class, 'id_area_responsable', 'id_area');
    }
    
    /**
     * Relación N:1 con el Usuario Responsable (users).
     * Usa el nuevo nombre de campo: id_responsable.
     */
    public function responsable(): BelongsTo
    {
        // Une denuncia.id_responsable con users.id
        return $this->belongsTo(User::class, 'id_responsable', 'id');
    }
    
    public function municipio()
    {
        return $this->hasOneThrough(
            CatMunicipios::class,          // Modelo destino
            DenunciaCircunstancia::class, // Modelo intermedio
            'id_denuncia',                // FK en DenunciaCircunstancia que apunta a Denuncia
            'id_municipio',               // PK en CatMunicipio
            'id_denuncia',                // Local key en Denuncia
            'id_municipio'                // Local key en DenunciaCircunstancia
        );
    }

    // Scope para mostrar las denuncias que pertenecen a los usuarios OIC
    public function scopeDenunciasByResponsable($query){

        return $query->where('id_responsable', Auth::user()->id);
    }
}