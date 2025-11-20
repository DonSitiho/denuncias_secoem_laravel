<?php

namespace App\Http\Controllers\Apps;

use App\DataTables\UsersDataTable;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Area;
use App\Models\Denuncia;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(UsersDataTable $dataTable)
    {
        return $dataTable->render('pages/apps.user-management.users.list');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    // public function show(User $user)
    // {
    //     //roles
    //     $roles = Role::where('id', '!=', 1)->get(); // Excluir el rol de Administrador Global (ID 1)

    //     return view('pages/apps.user-management.users.show', compact('user', 'roles'));
    // }
    public function show(User $user)
    {
        // CARGAMOS TODAS LAS RELACIONES REQUERIDAS POR LA VISTA SHOW
        $user->load(['roles', 'area', 'denunciasAsignadas']); 
        
        // 1. Obtener los roles para el modal (excluyendo el Admin General ID 1)
        $roles = \Spatie\Permission\Models\Role::where('id', '!=', 1)->get(); 

        // ⭐ 2. LÓGICA DE LA TABLA DINÁMICA: Denuncias Activas Asignadas
        // Filtramos por casos Turnados (2) o En Trámite (3) y por el ID del usuario
        $denunciasActivas = Denuncia::where('id_responsable', $user->id)
            ->whereIn('id_estado', [2, 3]) // 2: Turnada, 3: En Trámite
            ->with(['estado', 'circunstancia']) // Eager Load para la tabla
            ->orderBy('fecha_recepcion', 'desc')
            ->take(5) // Limitar a las últimas 5 denuncias activas
            ->get();
        
        // 3. Pasamos las variables a la vista
        return view('pages.apps.user-management.users.show', compact('user', 'roles', 'denunciasActivas'));
    }

    public function showChangePasswordForm()
    {
        return view('profile.change-password');
    }

    /**
     * Valida y actualiza la contraseña del usuario autenticado.
     */
    public function updatePassword(Request $request)
    {
        // 1. Validación de la contraseña actual
        $request->validate([
            'current_password' => ['required', 'string'],
            // 2. Validación de la nueva contraseña (Fuerte y Confirmación)
            'new_password' => [
                'required', 
                'string', 
                'confirmed', 
                // Usamos la regla compleja de Laravel 
                Password::min(8)
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
            ],
        ]);

        $user = Auth::user();

        // 3. Verificar si la contraseña actual es correcta
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'La contraseña actual ingresada es incorrecta.']);
        }
        
        // 4. Verificar que la nueva contraseña no sea la misma que la anterior
        if (Hash::check($request->new_password, $user->password)) {
            return back()->withErrors(['new_password' => 'La nueva contraseña debe ser diferente a la contraseña actual.']);
        }

        // 5. Actualizar la contraseña
        $user->password = Hash::make($request->new_password);
        $user->save();
        
        // 6. Retornar éxito
        return back()->with('success', 'Tu contraseña ha sido actualizada con éxito. Por favor, vuelve a iniciar sesión.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        // 1. VALIDACIÓN
        $request->validate([
            'new_password' => [
                'required', 
                'string', 
                'confirmed', 
                Password::min(8)->mixedCase()->symbols()
            ],
            // user_id_to_update se pasa por el formulario
            'user_id_to_update' => 'required|integer|exists:users,id', 
        ]);

        // 2. BUSCAR EL USUARIO y AUTORIZACIÓN
        // Ya que usamos Route Model Binding ($user), solo necesitamos verificar la autorización.
        // El Administrador Global (ID 1) tiene acceso a todo (lógica definida en RolesPermissionsSeeder).

        // Si el ID del request no coincide con el Route Model Binding, puede ser un error.
        if ($user->id != $request->user_id_to_update) {
            return response()->json(['message' => 'Conflicto de ID de usuario.'], 400);
        }

        // 3. ACTUALIZAR CONTRASEÑA
        $user->password = Hash::make($request->new_password);
        $user->save();
        
        // NOTA: Es buena práctica forzar al usuario a cerrar sesión en otros dispositivos.

        //return response()->json(['success' => true, 'message' => 'Contraseña restablecida con éxito para ' . $user->name]);
        
        return back()->with('success', 'Contraseña restablecida con éxito para ' . $user->name);
    }

    public function updateRole(Request $request, User $user)
    {
        // 1. VALIDACIÓN
        $request->validate([
            'role_name' => ['required', 'string', 'exists:roles,name'], 
        ]);

        $newRoleName = $request->role_name;

        // 2. REGLA DE NEGOCIO: Prohibir asignar el rol ID 1 (Administrador General)
        $adminRole = Role::where('id', 1)->first();
        if ($adminRole && $newRoleName === $adminRole->name) {
             return response()->json([
                 'message' => 'No está permitido asignar el rol de Administrador General (ID 1) mediante esta interfaz.',
                 'errors' => ['role_name' => ['Acción no permitida.']]
             ], 422);
        }
        
        // 3. ACTUALIZAR ROL
        try {
            $user->syncRoles($newRoleName); 

            return response()->json(['success' => true, 'message' => "El rol de {$user->name} fue cambiado a **{$newRoleName}**."]);

        } catch (\Exception $e) {
             return response()->json(['message' => 'Error al asignar el rol.'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
