<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\User;
use App\Models\Denuncia;

// Asumimos que los modelos de administración están en App\Models\AdminDenuncias
class Area extends Model
{
    use HasFactory;

    // Nombre de la tabla en la base de datos
    protected $table = 'areas';

    // Clave primaria
    protected $primaryKey = 'id_area';

    // Indica que la PK es BIGINT UNSIGNED y es auto-incremental
    public $incrementing = true;
    protected $keyType = 'int'; // Usamos 'int' o 'integer' para PK simple en Eloquent

    // Campos que pueden ser asignados masivamente (CRUD)
    protected $fillable = [
        'id_area_padre',
        'nombre_area',
        'nivel',
        'siglas',
        'is_active',
    ];

    // Casteo de atributos
    protected $casts = [
        'is_active' => 'boolean',
    ];


    // RELACIONES PARA ESTRUCTURA JERÁRQUICA DE ÁREAS JSTREE
    /**
     * Relación jerárquica N:1 (Padre). 
     * Obtiene el área superior inmediata de esta área.
     */
    public function padre(): BelongsTo
    {
        return $this->belongsTo(Area::class, 'id_area_padre', 'id_area');
    }

    /**
     * Relación jerárquica 1:N (Hijos).
     * Obtiene todas las áreas que dependen directamente de esta área.
     */
    public function hijos(): HasMany
    {
        return $this->hasMany(Area::class, 'id_area_padre', 'id_area');
    }
    

    // RELACIONES DE PROYECTO
    /**
     * Relación 1:N con los usuarios adscritos a esta área.
     * Asume que el modelo de usuario es App\Models\User.
     */
    public function usuarios(): HasMany
    {
        // Une users.id_area con areas.id_area
        return $this->hasMany(User::class, 'id_area', 'id_area');
    }

    /**
     * Relación 1:N con las denuncias que han sido turnadas a esta área.
     * Utilizado para la asignación de responsabilidad.
     */
    public function denunciasAsignadas(): HasMany
    {
        // Une denuncia.id_area_responsable con areas.id_area
        return $this->hasMany(Denuncia::class, 'id_area_responsable', 'id_area');
    }
}