<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatAreaGob extends Model
{
    use HasFactory;

    protected $table = 'cat_areas_gob';
    protected $primaryKey = 'id_area';

    protected $fillable = [
        'id_area_padre',
        'nombre',
        'siglas',
        'categoria',
        'is_active',
    ];

    // Relación con área padre
    public function padre()
    {
        return $this->belongsTo(CatAreaGob::class, 'id_area_padre');
    }

    // Relación con áreas hijas
    public function hijos()
    {
        return $this->hasMany(CatAreaGob::class, 'id_area_padre');
    }
}
