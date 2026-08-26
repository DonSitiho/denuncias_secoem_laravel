<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
            'oic-denuncia-descargar',
            'oic-denuncia-turnar',
            'oic-denuncia-solventar-info',
            'oic-denuncia-crear',
            'oic-denuncia-tramite',
            'oic-denuncia-etiquetar',
            
            // PERMISOS ADMIN GENERAL (Gestión de Catálogos/Usuarios Internos)
            'admin-areas-crud',
            'admin-usuarios-crud',
            'admin-catalogos-crud',
            
            // PERMISOS ADMIN DENUNCIAS (Operación y Asignación)
            'admin-denuncia-ver',
            'admin-denuncia-turnar',
            'admin-denuncia-descargar',
            
            // PERMISOS SÚPER ADMINISTRADOR (Gestión de Sistema)
            'system-roles-crud',
            'system-permissions-crud',
            'system-auditoria-ver',
            'system-configuracion-crud',

            // PERMISO PARA OBTENER LOS USUARIOS POR AREAS
            'system-areas-usuarios',
            
            // PERMISOS UAOIC (Operacion y Asignacion a OICS)
            /*
            'uaoic-denuncia-ver',
            'uaoic-denuncia-turnar',
            'uaoic-denuncia-descargar',
            'uaoic-denuncia-detalles',
            */
            // PERMISOS BUZON NARANJA (Operacion y Asignacion)
            'bn-denuncia-ver',
            'bn-denuncia-turnar',
            'bn-denuncia-descargar',
            'bn-denuncia-detalles',

            'st-denuncia-capturar',
            'st-denuncia-folio',
            
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
            
            'Admin Denuncias ST' => [
                'admin-denuncia-ver',
                'admin-denuncia-turnar',
                'admin-denuncia-descargar',
                'admin-usuarios-crud',
                'admin-areas-crud',
                'admin-catalogos-crud',
                'bn-denuncia-ver',
                'bn-denuncia-turnar',
                'bn-denuncia-detalles',
                'st-denuncia-capturar',
                'st-denuncia-folio',
            ],
            
            /*
            'Usuario UAOIC' => [
                'uaoic-denuncia-ver',
                'uaoic-denuncia-turnar',
                'uaoic-denuncia-descargar',
                'uaoic-denuncia-detalles',
                'system-areas-usuarios',
            ],
            */
            'Usuario OIC' => [
                'oic-denuncia-ver',
                'oic-denuncia-detalles',
                'oic-denuncia-descargar',
                'oic-denuncia-turnar',
                'oic-denuncia-solventar-info',
                'oic-denuncia-tramite',
                'oic-denuncia-etiquetar',
                'system-areas-usuarios',
            ],

            'Usuario BN' => [
                'bn-denuncia-ver',
                'bn-denuncia-turnar',
                'bn-denuncia-descargar',
                'bn-denuncia-detalles',
                'system-areas-usuarios',
            ],
            
            'Capturista' => [
                'oic-denuncia-ver',
                'oic-denuncia-detalles',
                'oic-denuncia-crear',
                'oic-denuncia-descargar',
                'oic-denuncia-solventar-info',
                'oic-denuncia-tramite',
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
        User::find(2)?->assignRole('Admin Denuncias ST');
        //User::find(3)?->assignRole('Usuario UAOIC');
        User::find(3)?->assignRole('Usuario OIC');
        User::find(4)?->assignRole('Usuario OIC');
        User::find(5)?->assignRole('Usuario BN');
        User::find(6)?->assignRole('Capturista');

        // ... y así sucesivamente para el resto de los usuarios de prueba.
    }
}