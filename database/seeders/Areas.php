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
        $uaoicId = DB::table('areas')->insertGetId([
            'id_area_padre' => $secretariaId,
            'nombre_area' => 'Unidad de Apoyo a Órganos Interno de Control',
            'siglas' => 'UAOIC',
            'nivel' => 'Dirección',
            'is_active' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 3. SECRETARIA TECNICA (Nivel 2)
        $stId = DB::table('areas')->insertGetId([
            'id_area_padre' => $secretariaId,
            'nombre_area' => 'Secretaría Técnica',
            'siglas' => 'ST',
            'nivel' => 'Dirección',
            'is_active' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 4. CONTRALORIA SOCIAL (Nivel 2)
        $stId = DB::table('areas')->insertGetId([
            'id_area_padre' => $secretariaId,
            'nombre_area' => 'Dirección de Ciudadanización y Contraloría social',
            'siglas' => 'DCSPC',
            'nivel' => 'Dirección',
            'is_active' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 5. OIC A (Nivel 3)
        $oicAId = DB::table('areas')->insertGetId([
            'id_area_padre' => $uaoicId,
            'nombre_area' => 'OIC A',
            'siglas' => 'OIC-A',
            'nivel' => '',
            'is_active' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 6. OIC B (Nivel 3)
        $oicId = DB::table('areas')->insertGetId([
            'id_area_padre' => $uaoicId,
            'nombre_area' => 'OIC B',
            'siglas' => 'OIC-B',
            'nivel' => '',
            'is_active' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        

        // 7. OIC C (Nivel 3)
        $oicId = DB::table('areas')->insertGetId([
            'id_area_padre' => $uaoicId,
            'nombre_area' => 'OIC C',
            'siglas' => 'OIC-C',
            'nivel' => '',
            'is_active' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        // 9. OIC D (Nivel 3)
        $oicId = DB::table('areas')->insertGetId([
            'id_area_padre' => $uaoicId,
            'nombre_area' => 'OIC D',
            'siglas' => 'OIC-D',
            'nivel' => '',
            'is_active' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        // 10. OIC E (Nivel 3)
        $oicId = DB::table('areas')->insertGetId([
            'id_area_padre' => $uaoicId,
            'nombre_area' => 'OIC E',
            'siglas' => 'OIC-E',
            'nivel' => '',
            'is_active' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        // 11. OIC F (Nivel 3)
        $oicId = DB::table('areas')->insertGetId([
            'id_area_padre' => $uaoicId,
            'nombre_area' => 'OIC F',
            'siglas' => 'OIC-F',
            'nivel' => '',
            'is_active' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        // 12. OIC G (Nivel 3)
        $oicId = DB::table('areas')->insertGetId([
            'id_area_padre' => $uaoicId,
            'nombre_area' => 'OIC G',
            'siglas' => 'OIC-G',
            'nivel' => '',
            'is_active' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 13. OIC H (Nivel 3)
        $oicId = DB::table('areas')->insertGetId([
            'id_area_padre' => $uaoicId,
            'nombre_area' => 'OIC H',
            'siglas' => 'OIC-H',
            'nivel' => '',
            'is_active' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 14. OIC I (Nivel 3)
        $oicId = DB::table('areas')->insertGetId([
            'id_area_padre' => $uaoicId,
            'nombre_area' => 'OIC I',
            'siglas' => 'OIC-I',
            'nivel' => '',
            'is_active' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        // 15. OIC J (Nivel 3)
        $oicId = DB::table('areas')->insertGetId([
            'id_area_padre' => $uaoicId,
            'nombre_area' => 'OIC J',
            'siglas' => 'OIC-J',
            'nivel' => '',
            'is_active' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        // 16. OIC K (Nivel 3)
        $oicId = DB::table('areas')->insertGetId([
            'id_area_padre' => $uaoicId,
            'nombre_area' => 'OIC K',
            'siglas' => 'OIC-K',
            'nivel' => '',
            'is_active' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        // 17. OIC L (Nivel 3)
        $oicId = DB::table('areas')->insertGetId([
            'id_area_padre' => $uaoicId,
            'nombre_area' => 'OIC L',
            'siglas' => 'OIC-L',
            'nivel' => '',
            'is_active' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        
        // 18. JEFATURA OIC (Nivel 3)
        $jefaturaId = DB::table('areas')->insertGetId([
            'id_area_padre' => $oicAId,
            'nombre_area' => 'Jefatura OIC',
            'siglas' => 'JOIC',
            'nivel' => 'Jefatura',
            'is_active' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        // 19. CAPTURISTA OIC (Nivel 4)
        $capturistaId = DB::table('areas')->insertGetId([
            'id_area_padre' => $oicAId,
            'nombre_area' => 'Capturista OIC',
            'siglas' => 'CAP',
            'nivel' => 'Operativo',
            'is_active' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        
        
    }
}
