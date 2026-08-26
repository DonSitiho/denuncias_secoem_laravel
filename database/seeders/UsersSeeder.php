<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Generator;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        $defaultPassword = Hash::make('D3nunci4s2026#');
        $domain = '@denuncias.secoem.gob.mx';
        
        // 1. Administrador del Sistema
        $adminUser = User::create([
            'name'              => 'Admin System',
            'email'             => 'admin' . $domain,
            'password'          => $defaultPassword,
            'email_verified_at' => now(),
            'id_area'           => 1, // Asume la existencia de un área con ID 1
        ]);
        //$adminUser->assignRole('Administrador'); Se asignan roles en RoleSeeder

        // 2. Administrador de Denuncias
        $denunciasStUser = User::create([
            'name'              => 'Admin Denuncias ST',
            'email'             => 'denuncias_st' . $domain,
            'password'          => $defaultPassword,
            'email_verified_at' => now(),
            'id_area'           => 3, // Asume la existencia de un área con ID 2
        ]);
        //$denunciasUser->assignRole('Admin Denuncias ST');
        
        // 3. Usuario UAOIC
        /*
        $uaoicUser = User::create([
            'name'              => 'Usuario UAOIC',
            'email'             => 'uaoic' . $domain,
            'password'          => $defaultPassword,
            'email_verified_at' => now(),
            'id_area'           => 2, // Asume la existencia de un área con ID 3
        ]);
        */
        //$oicUser->assignRole('Usuario UAOIC');
        
        // 4. Usuarios OIC
        $oicAUser = User::create([
            'name'              => 'Usuario OIC A',
            'email'             => 'oic-a' . $domain,
            'password'          => $defaultPassword,
            'email_verified_at' => now(),
            'id_area'           => 5, // Asume la existencia de un área con ID 3
        ]);
        //$oicUser->assignRole('Usuario OIC');

        $oicBUser = User::create([
            'name'              => 'Usuario OIC B',
            'email'             => 'oic-b' . $domain,
            'password'          => $defaultPassword,
            'email_verified_at' => now(),
            'id_area'           => 6, // Asume la existencia de un área con ID 3
        ]);

        // 5. Usuario Buzon Naranja
        $bnUser = User::create([
            'name'              => 'Usuario BN',
            'email'             => 'bn' . $domain,
            'password'          => $defaultPassword,
            'email_verified_at' => now(),
            'id_area'           => 4, // Asume la existencia de un área con ID 4
        ]);
        //$oicUser->assignRole('Usuario BN');

        // 6. Capturista
        $capturistaUser = User::create([
            'name'              => 'Capturista',
            'email'             => 'capturista' . $domain,
            'password'          => $defaultPassword,
            'email_verified_at' => now(),
            'id_area'           => 17, // Asume la existencia de un área con ID 4
        ]);
        //$capturistaUser->assignRole('Capturista');

        // -----------------------------------------------------------
        // NOTA: Los usuarios de prueba originales de Metronic (demo@demo.com y admin@demo.com)
        // han sido eliminados para usar los correos institucionales de SICODEN.
        // -----------------------------------------------------------
    }
}
