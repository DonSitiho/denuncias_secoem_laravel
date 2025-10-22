<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CatEstadosSeeder extends Seeder
{
    /**
     * Ejecuta el seeder de la tabla cat_estados.
     */
    public function run(): void
    {
        // 1. Borrar (Truncar) los registros existentes en la tabla
        // Esto vacía la tabla y reinicia el contador de ID de autoincremento.
        DB::table('cat_estados')->truncate(); 

        // Si prefieres borrar sin reiniciar el contador de ID:
        // DB::table('cat_estados')->delete();

        // 2. Insertar los nuevos o actualizados registros (Actualización)
        DB::table('cat_estados')->insert([
            [
                'id_tipo' => 1,
                'nombre' => 'Recibida',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_tipo' => 1,
                'nombre' => 'En trámite',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_tipo' => 1,
                // Si quieres "actualizar" uno, cambias el valor aquí:
                'nombre' => 'Cerrada', 
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Puedes añadir nuevos registros aquí si lo deseas
        ]);
    }
}