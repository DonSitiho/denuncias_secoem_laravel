<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Lista Completa de Permisos Explícitos (Tu Estructura + System Admin)
        $allPermissions = [
            // PERMISOS OIC (Usuario OIC y Capturista)
            'oic-denuncia-ver',
            'oic-denuncia-detalles',
            'oic-denuncia-descarga',
            'oic-denuncia-solventar-info',
            'oic-denuncia-crear', 
            
            // PERMISOS ADMIN GENERAL (Gestión de Catálogos/Usuarios Internos)
            'admin-areas-crud',
            'admin-usuarios-crud',
            
            // PERMISOS ADMIN DENUNCIAS (Operación y Asignación)
            'admin-denuncia-ver',
            'admin-denuncia-turnar',
            'admin-denuncia-descarga',
            
            // PERMISOS SÚPER ADMINISTRADOR (Gestión de Sistema)
            'system-roles-crud',
            'system-permissions-crud',
            'system-auditoria-ver',
            'system-configuracion-crud',
        ];

        // 2. Crear todos los Permisos en la base de datos
        // -----------------------------------------------------------
        foreach ($allPermissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // 3. Definición de Permisos por Rol (Usando tus 4 roles)
        // Usaremos esta matriz para asignar los permisos creados
        $permissions_by_role = [
            'Administrador' => [
                'full_access' => true, 
            ],
            
            'Admin Denuncias' => [
                'admin-denuncia-ver',
                'admin-denuncia-turnar',
                'admin-denuncia-descarga',
                'admin-usuarios-crud',
                'admin-areas-crud',
            ],
            
            'Usuario OIC' => [
                'oic-denuncia-ver',
                'oic-denuncia-detalles',
                'oic-denuncia-descarga',
                'oic-denuncia-solventar-info',
            ],
            
            'Capturista' => [
                'oic-denuncia-ver',
                'oic-denuncia-detalles',
                'oic-denuncia-crear',
            ],
        ];

        // 4. Crear Roles y Sincronizar Permisos
        // -----------------------------------------------------------
        foreach ($permissions_by_role as $roleName => $permissions) {
            $role = Role::firstOrCreate(['name' => $roleName]);
            
            if (isset($permissions['full_access']) && $permissions['full_access'] === true) {
                // Asigna TODOS los permisos existentes al Administrador
                $role->syncPermissions(Permission::all());
            } else {
                // Sincroniza los permisos específicos
                $role->syncPermissions($permissions);
            }
        }

        // 5. Asignación a Usuarios Existentes (Si el UsersSeeder no lo hizo)
        // -----------------------------------------------------------
        // NOTA: Si ya lo hiciste en UsersSeeder.php, puedes borrar esta sección
        User::find(1)?->assignRole('Administrador');
        User::find(2)?->assignRole('Admin Denuncias');
        User::find(3)?->assignRole('Usuario OIC');
        User::find(4)?->assignRole('Capturista');
        // ... y así sucesivamente para el resto de los usuarios de prueba.
    }
}