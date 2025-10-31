<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Generator;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role; // Necesario para asignar roles

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Generator $faker)
    {
        // Contraseña por defecto para todos los usuarios de prueba
        $defaultPassword = Hash::make('demo');
        $domain = '@denuncias.secoem.gob.mx';
        
        // 1. Administrador del Sistema
        $adminUser = User::create([
            'name'              => 'Admin System',
            'email'             => 'admin' . $domain,
            'password'          => $defaultPassword,
            'email_verified_at' => now(),
            'id_area'           => 1, // Asume la existencia de un área con ID 1
        ]);
        //$adminUser->assignRole('Administrador');

        // 2. Administrador de Denuncias
        $denunciasUser = User::create([
            'name'              => 'Admin Denuncias',
            'email'             => 'denuncias' . $domain,
            'password'          => $defaultPassword,
            'email_verified_at' => now(),
            'id_area'           => 2, // Asume la existencia de un área con ID 2
        ]);
        //$denunciasUser->assignRole('Admin Denuncias');
        
        // 3. Usuario OIC
        $oicUser = User::create([
            'name'              => 'Usuario OIC',
            'email'             => 'oic' . $domain,
            'password'          => $defaultPassword,
            'email_verified_at' => now(),
            'id_area'           => 3, // Asume la existencia de un área con ID 3
        ]);
        //$oicUser->assignRole('Usuario OIC');
        
        // 4. Capturista
        $capturistaUser = User::create([
            'name'              => 'Capturista',
            'email'             => 'capturista' . $domain,
            'password'          => $defaultPassword,
            'email_verified_at' => now(),
            'id_area'           => 4, // Asume la existencia de un área con ID 4
        ]);
        //$capturistaUser->assignRole('Capturista');
        
        // -----------------------------------------------------------
        // NOTA: Los usuarios de prueba originales de Metronic (demo@demo.com y admin@demo.com)
        // han sido eliminados para usar los correos institucionales de SICODEN.
        // -----------------------------------------------------------
    }
}
