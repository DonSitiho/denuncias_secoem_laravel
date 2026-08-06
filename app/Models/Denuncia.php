<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
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
        'clave_denunciante',
        'fecha_cierre',
        'id_denunciante',
        'tipo_denuncia',
    ];

    protected $casts = [
        'es_anonima' => 'boolean',
        'fecha_recepcion' => 'datetime',
        'dinero_solicitado' => 'decimal:2',
        'fecha_cierre' => 'datetime',
        'tipo_denuncia' => 'integer',
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

    // Relacion 1:N con solventar informacion de la denuncia
    public function solventarInfo(): HasMany
    {
        return $this->hasMany(SolventarInfo::class, 'id_denuncia', 'id_denuncia');
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

    public function turnados(): HasMany
    {
        return $this->hasMany(DenunciaTurnadoHistorial::class, 'id_denuncia', 'id_denuncia')->orderBy('fecha_turnado');;
    }
    
    public function scopeDenunciasByAreaResponable($query){

        $user = Auth::user();

        return $query->where(function ($q) use ($user) {
            // Denuncias sin responsable, visibles para todos del área
            $q->whereNull('id_responsable')
            ->where('id_area_responsable', $user->id_area);
        })->orWhere(function ($q) use ($user) {
            // Denuncias con responsable, solo visibles para ese usuario en el área
            $q->where('id_responsable', $user->id)
            ->where('id_area_responsable', $user->id_area);
        });
    }

    // Scope para mostrar las denuncias por Area.
    public function scopeDenunciasArea($query){

        $userArea = Auth::user()->id_area;

        if (!$userArea) {
            // Devuelve un query vacío
            return $query->whereRaw('1 = 0');
        }

        return $query->where('id_area_responsable', $userArea);

    }

    // Scope para mostrar las denuncias por area del responsable en especifico
    public function scopeDenunciasAreaResponsable($query){

        $user = Auth::user();
        $idArea = $user->id_area;
        $idUsuario = $user->id;

        return$query->whereHas('turnados', function (Builder $q) use ($idArea, $idUsuario) {
            $q->where('id_area_destino', $idArea)
                ->where(function (Builder $sub) use ($idUsuario) {
                    $sub->whereNull('id_responsable')
                        ->orWhere('id_responsable', $idUsuario);
                });
        });
    }

    // Scope para mostrar las denuncias por estatus de un responable en especifico.
    public function scopeDenunciasEstatus($query, $id_status){

        return $query->where('id_estado', $id_status)
                    ->where(function ($q){
                        $q->where('id_responsable', Auth::id())
                            ->orWhere(function ($sub){
                                $sub->where('id_area_responsable', Auth::user()->id_area)
                                    ->whereNull('id_responsable');
                            });
                    });
    }

    // Scope para mostrar las denuncias anonimas y no anominas de un responable en especifico.
    public function scopeDenunciasAnonimas($query, $anonima){

        return $query->where('es_anonima', $anonima)
                    ->where(function ($q){
                        $q->where('id_responsable', Auth::id())
                            ->orWhere(function ($sub){
                                $sub->where('id_area_responsable', Auth::user()->id_area)
                                    ->whereNull('id_responsable');
                            });
                    });
    }

    // Scope para mostrar las denuncias por tipo de denuncia (Buzon naranja y denuncias).
    public function scopeDenunciasByTipo(Builder $query, int $tipo): Builder {

        return $query->where('tipo_denuncia', $tipo);
    }


}