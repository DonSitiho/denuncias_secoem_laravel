<?php

namespace App\Http\Controllers\AdminDenuncias;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Area;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rule;


class AdminUserController extends Controller
{
    //
    /**
     * Muestra el listado de usuarios internos.
     */
    public function index()
    {
        $usuarios = User::with('area')->whereNotNull('id_area')->orderBy('name')->paginate(15);
        $areas = Area::where('is_active', true)->orderBy('nombre_area')->get(); // Carga de todas las áreas activas
        
        // La vista debe ser index.blade.php que incluye el modal
        return view('admin-denuncias.usuarios.index', compact('usuarios', 'areas'));
    }
    
    /**
     * Almacena un nuevo usuario interno, generando el usuario (correo) y contraseña por defecto.
     */
    public function store(Request $request)
    {
        // 1. VALIDACIÓN
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'apellido_paterno' => ['required', 'string', 'max:100'],
            'apellido_materno' => ['nullable', 'string', 'max:100'],
            'username_part' => ['required', 'string', 'alpha_dash', 'min:3'], 
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')], 
            'id_area' => ['required', 'integer', 'exists:areas,id_area'],
        ], [
            // Mensaje de error personalizado para la unicidad del email
            'email.unique' => 'El nombre de usuario seleccionado se encuentra utilizado, cámbielo por otro.',
            'username_part.required' => 'Debe ingresar un nombre de usuario.',
        ]);

        // 2. ASIGNACIÓN DE DATOS FINALES
        $emailFinal = $request->input('email');
        $defaultPassword = $emailFinal; 
        $defaultRole = 'developer'; // Rol por defecto

        // 3. CREACIÓN DEL USUARIO
        $user = User::create([
            'name' => $request->name . ' ' . $request->apellido_paterno . ' ' . $request->apellido_materno,
            'email' => $emailFinal,
            'password' => Hash::make($defaultPassword),
            'id_area' => $request->id_area,
        ]);

        // 4. ASIGNACIÓN DE ROL
        $user->assignRole($defaultRole);

        // 5. RETORNO con mensaje de éxito y la contraseña inicial
        return redirect()->route('admin.usuarios.index')
                         ->with('success', "Usuario '{$user->email}' creado y asignado. Contraseña inicial: {$defaultPassword}");
    }
}
