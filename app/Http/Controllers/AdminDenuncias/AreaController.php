<?php

namespace App\Http\Controllers\AdminDenuncias;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Area;

class AreaController extends Controller
{
    /**
     * Muestra la vista principal del gestor jerárquico de áreas.
     */
    public function index()
    {
        // Se asume que el middleware 'can:admin-areas-crud' ya protegió esta ruta.
        return view('admin-denuncias.areas.index');
    }

    /**
     * API: Devuelve la estructura jerárquica de áreas en formato compatible con jsTree.
     */
    public function getTreeData()
    {
        
        $areas = Area::all();
        $treeData = [];

        foreach ($areas as $area) {
            $treeData[] = [
                'id' => $area->id_area,
                // Si el id_area_padre es nulo, es nodo raíz ('#')
                'parent' => $area->id_area_padre ?? '#',
                'text' => "{$area->nombre_area} ({$area->siglas})",
                'state' => [
                    'opened' => false, // Cerrado por defecto
                    'disabled' => !$area->is_active, // Deshabilitar si no está activa
                ],
                // Datos adicionales para edición
                'li_attr' => [
                    'data-siglas' => $area->siglas,
                    'data-nivel' => $area->nivel,
                ]
            ];
        }

        return response()->json($treeData);
    }

    /**
     * API: Maneja las operaciones CRUD (crear, renombrar, mover, eliminar) solicitadas por jsTree.
     */
    public function crud(Request $request)
    {
        $operation = $request->input('operation');
        
        // Iniciar la transacción para asegurar la integridad jerárquica
        DB::beginTransaction();

        try {
            switch ($operation) {
                case 'create_node':
                    // Lógica para crear un nodo hijo o raíz
                    
                    $parentId = $request->input('parent') === '#' ? null : $request->input('parent');
                    
                    $area = Area::create([
                        'nombre_area' => $request->input('text'),
                        // Si las siglas vienen vacías, usamos 'SN' (Sin Nombre)
                        'siglas' => $request->input('siglas', '') ?: 'S/N', 
                        // El nivel se guarda directamente como string
                        'nivel' => $request->input('nivel', '') ?: 'S/N', 
                        'id_area_padre' => $parentId,
                        'is_active' => true, // Aseguramos que esté activo por defecto
                    ]);
                    
                    DB::commit();
                return response()->json(['id' => $area->id_area]);

                case 'rename_node':
                    // Lógica para renombrar un nodo
                    $area = Area::findOrFail($request->input('id'));
                    $area->nombre_area = $request->input('text');
                    $area->save();
                    DB::commit();
                    return response()->json(true);

                case 'delete_node':
                    // Lógica para eliminar un nodo
                    Area::findOrFail($request->input('id'))->delete();
                    DB::commit();
                    return response()->json(true);

                case 'move_node':
                    // 1. Obtener el área que se está moviendo
                    $area = Area::findOrFail($request->input('id'));
                    
                    // 2. Determinar el nuevo padre
                    $newParentId = $request->input('parent');
                    
                    // 3. Asignar el nuevo padre: 
                    // Si el nuevo padre es '#', significa que se movió a la raíz (NULL).
                    $area->id_area_padre = ($newParentId === '#') ? null : $newParentId;
    
                    // Opcional: Actualizar el nivel (si se requiere una lógica precisa)
                    // $area->nivel = $request->input('position'); 
    
                    $area->save();
                        
                    DB::commit();
                    return response()->json(true);

                default:
                    DB::rollBack();
                    return response()->json(['error' => 'Operación no soportada'], 400);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}