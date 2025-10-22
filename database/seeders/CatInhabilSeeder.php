<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CatInhabilSeeder extends Seeder
{
    /**
     * Ejecuta el seeder de la tabla cat_inhabil.
     */
    public function run(): void
    {
        DB::table('cat_inhabil')->insert([
            [
                'fecha' => '2025-01-01',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'fecha' => '2025-09-16',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
