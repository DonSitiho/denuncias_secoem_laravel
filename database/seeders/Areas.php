<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // Usamos DB Facade para inserción
// use App\Models\Area; // Si prefieres usar el modelo

class Areas extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Limpiamos la tabla para evitar duplicados en cada ejecución
        // NOTA: Si ya tienes datos en producción, usa un 'firstOrCreate' en lugar de truncate
        //DB::table('areas')->truncate();

        // 1. SECRETARÍA (Nivel 1 - Raíz)
        $secretariaId = DB::table('areas')->insertGetId([
            'id_area_padre' => null, // Es la raíz
            'nombre_area' => 'Secretaría',
            'siglas' => 'SEC',
            'nivel' => 'Secretaría',
            'is_active' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        // 2. ÓRGANO INTERNO DE CONTROL (Nivel 2)
        $oicId = DB::table('areas')->insertGetId([
            'id_area_padre' => $secretariaId,
            'nombre_area' => 'Órgano Interno de Control',
            'siglas' => 'OIC',
            'nivel' => 'Dirección',
            'is_active' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        // 3. JEFATURA OIC (Nivel 3)
        $jefaturaId = DB::table('areas')->insertGetId([
            'id_area_padre' => $oicId,
            'nombre_area' => 'Jefatura OIC',
            'siglas' => 'JOIC',
            'nivel' => 'Jefatura',
            'is_active' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        // 4. CAPTURISTA OIC (Nivel 3)
        $capturistaId = DB::table('areas')->insertGetId([
            'id_area_padre' => $oicId,
            'nombre_area' => 'Capturista OIC',
            'siglas' => 'CAP',
            'nivel' => 'Operativo',
            'is_active' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
    }
}
