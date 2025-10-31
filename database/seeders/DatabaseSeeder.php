<?php

namespace Database\Seeders;

use App\Models\Address;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            Areas::class,
            UsersSeeder::class,
            RolesPermissionsSeeder::class,

            // 👇 Tus nuevos catálogos
            CatEstadosSeeder::class,
            CatAreasGobSeeder::class,
            CatMunicipiosSeeder::class,
            //CatAreasSecoemSeeder::class,
            //CatInhabilSeeder::class,
        ]);

        \App\Models\User::factory(20)->create();
        Address::factory(20)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}

