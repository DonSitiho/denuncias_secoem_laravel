<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CatAreasGobSeeder extends Seeder
{
    /**
     * Ejecuta el seeder de la tabla cat_areas_gob.
     */
       
    public function run(): void
    {

        // 1. Borrar (Truncar) los registros existentes en la tabla
        // Esto vacía la tabla y reinicia el contador de ID de autoincremento.
        DB::table('cat_areas_gob')->truncate(); 

        // Si prefieres borrar sin reiniciar el contador de ID:
        // DB::table('cat_estados')->delete();
    

        DB::table('cat_areas_gob')->insert([
            [
                'id_usuario' => null,
                'id_pad' => null,
                'siglas' => 'DG',
                'nombre' => 'Despacho del Gobernador',
                'telefono' => '4433229000',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_usuario' => null,
                'id_pad' => null,
                'siglas' => 'SEP',
                'nombre' => 'Secretaría de Educación Pública',
                'telefono' => '4437654321',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
