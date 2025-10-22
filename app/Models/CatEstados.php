<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatEstados extends Model
{
    use HasFactory;

    protected $table = 'cat_estados';
    protected $primaryKey = 'id_estado';
    public $timestamps = true;

    protected $fillable = [
        'id_tipo',
        'nombre',
        'is_active',
    ];
}
