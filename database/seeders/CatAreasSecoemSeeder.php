<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CatAreasSecoemSeeder extends Seeder
{
    /**
     * Ejecuta el seeder de la tabla cat_areas_secoem.
     */
    public function run(): void
    {
        DB::table('cat_areas_secoem')->insert([
            [
                'id_usuario' => null,
                'id_pad' => null,
                'nivel' => 1,
                'siglas' => 'OIC',
                'nombre' => 'Órgano Interno de Control',
                'telefono' => '4431112233',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_usuario' => null,
                'id_pad' => 1,
                'nivel' => 2,
                'siglas' => 'AUD',
                'nombre' => 'Área de Auditoría',
                'telefono' => '4432223344',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
