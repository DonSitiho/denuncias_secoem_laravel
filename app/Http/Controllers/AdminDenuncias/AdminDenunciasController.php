<?php

namespace App\Http\Controllers\AdminDenuncias;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Denuncia;
use App\Models\DocDenuncias;
use App\Models\Area;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use App\Models\ArchivoAdjunto;
use Illuminate\Support\Facades\Storage;
use App\Helpers\ArchivoHelper;
use App\Models\DenunciaTurnadoHistorial;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AdminDenunciasController extends Controller
{
    // Eliminamos la inyección del CifradoService en el constructor.
    // public function __construct(CifradoService $cifradoService) 
    // { 
    //     $this->cifradoService = $cifradoService;
    // }

    /**
     * Muestra el Dashboard de Recepción (Bandeja de Entrada).
     */
    public function index(Request $request)
    {
        // El middleware 'can:admin-denuncia-ver' ya protegió el acceso.

        $denuncias = Denuncia::with([
            'circunstancia', // Relación 1:1 con DenunciaCircunstancia (existe en tu modelo)
            'contacto',      // Relación 1:1 con DatosContactoDenunciante (existe en tu modelo)
            'estado',        // Relación N:1 con CatEstados (existe en tu modelo)
            'areaResponsable', // Relación N:1 con Area (existe en tu modelo)
        ])
            ->orderBy('fecha_recepcion', 'desc') // Ordenado por fecha de recepción
            ->paginate(15);

        return view('admin-denuncias.index', compact('denuncias'));
    }

    /**
     * Muestra la Vista Detalle de una Denuncia específica.
     */
    public function show($id_denuncia)
    {
        /**
         * Muestra la vista detallada de una denuncia específica para su revisión administrativa.
         * Carga las relaciones directas que contienen la información de captura del ciudadano.
         * * El acceso a esta función está previamente protegido por el middleware 'can:admin-denuncia-ver'.
         */

        $denuncia = Denuncia::with([
            'circunstancia', // Carga los detalles de ubicación, fecha y dependencia
            'involucrados',  // Carga la lista de personas denunciadas y su descripción física
            'testigos',      // Carga los datos de los testigos
            'archivos',      // Carga los metadatos de las evidencias adjuntas
            'contacto',      // Carga el nombre, teléfono y correo del denunciante (si no es anónima)
            'estado',        // Carga el estado actual de la denuncia
            'areaResponsable', // Carga el área responsable asignada
            'responsable',   // Carga el usuario OIC responsable asignado
        ])
            ->findOrFail($id_denuncia);


        $user = Auth::user();

        if ($user->id_area == 3) {
            $areaResponsable = Area::where('is_active', true)->whereBetween('id_area', [5, 16])->get();

            // Cargar usuarios que tienen asignado un id_area en la tabla users
            $usuariosOIC = User::whereBetween('id_area', [5, 16])
                ->orderBy('name', 'asc')
                ->get();
        } else {
            $areaResponsable = Area::where('is_active', true)->get();

            // Cargar usuarios que tienen asignado un id_area en la tabla users
            $usuariosOIC = User::whereNotNull('id_area')
                ->orderBy('name', 'asc')
                ->get();
        }

        return view('admin-denuncias.show', compact('denuncia', 'areaResponsable', 'usuariosOIC'));
    }

    /**
     * Descarga y desencripta el archivo adjunto para el administrador.
     * La ruta está protegida por el middleware 'can:admin-denuncia-descarga'.
     * * @param int $id_archivo ID del ArchivoAdjunto.
     * @return \Illuminate\Http\Response|\Symfony\Component\HttpFoundation\StreamedResponse
     */
    public function descargarArchivoEncriptado($id_archivo)
    {
        try {
            $archivo = ArchivoAdjunto::with('denuncia')->findOrFail($id_archivo);

            // Aseguramos que el usuario logueado tenga derecho a ver esta denuncia específica.
            if (Gate::denies('admin-denuncia-descargar')) {
                // Si falla el permiso general de descarga
                return redirect()->back()->with('error', 'Permisos insuficientes para esta acción.');
            }

            // Opcional: Si necesitas chequear que la denuncia le pertenece (Policy por objeto)
            // if (Gate::denies('view', $archivo->denuncia)) { 
            //     return redirect()->back()->with('error', 'No tiene permisos sobre esta denuncia.');
            // }

            return ArchivoHelper::descargarArchivoEncriptado(
                $archivo->ruta_cifrada,
                $archivo->nombre_original,
                $archivo->tipo_archivo, // Se puede usar el campo 'tipo_archivo' del modelo para el MIME type
                true // Forzar descarga (descargar=true)
            );
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'El archivo solicitado no existe.');
        } catch (\Exception $e) {
            Log::error("Error al servir archivo encriptado (Admin): " . $e->getMessage());
            return redirect()->back()->with('error', 'Error al acceder o desencriptar el archivo de prueba.');
        }
    }

    /**
     * Acción POST para turnar la denuncia a un Usuario OIC.
     */
    /**
     * Acción POST para turnar la denuncia al Área Responsable.
     */
    public function turnar(Request $request, $id_denuncia)
    {
        // El middleware 'can:admin-denuncia-turnar' ya protegió el acceso.

        // 1. VALIDACIÓN ACTUALIZADA
        $request->validate([
            'id_area_responsable' => 'required|integer|exists:areas,id_area', // Área es OBLIGATORIA
            'id_responsable' => 'nullable|integer|exists:users,id', // Usuario específico es OPCIONAL
        ]);

        try {
            DB::beginTransaction();

            $usuario = auth()->user();

            $denuncia = Denuncia::findOrFail($id_denuncia);

            // 2. ASIGNACIÓN ACTUALIZADA DE RESPONSABILIDAD
            $denuncia->id_area_responsable = $request->id_area_responsable;
            $denuncia->id_responsable = $request->id_responsable; // ⬅️ Usando el nuevo nombre de campo
            $denuncia->id_estado = 2; // Asumir '2' es 'Turnada al Área'

            DenunciaTurnadoHistorial::create([
                'id_denuncia'        => $denuncia->id_denuncia,
                'id_area_origen'     => $usuario->id_area,
                'id_area_destino'    => $request->id_area_responsable,
                'id_responsable' => $request->id_responsable,
                'fecha_turnado'      => now(),
            ]);


            // Opcional: Asignar no_expediente_inter aquí si es el primer turno
            $denuncia->save();

            // Lógica de Notificación (Pendiente D3/D4)

            DB::commit();

            return redirect()->route('admin.denuncias.show', $id_denuncia)
                ->with('success', 'Denuncia turnada exitosamente al área responsable.');
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error("Error al turnar denuncia: " . $e->getMessage());
            return redirect()->back()->with('error', 'Fallo al realizar el turno. Intente de nuevo.');
        }
    }

    /**
     * Obtiene los usuarios pertenecientes a un área específica.
     */
    public function getUsersForArea($id_area)
    {
        // Cargar usuarios que pertenecen al área dada
        $usuarios = User::where('id_area', $id_area)
            ->whereNotNull('id_area')
            ->orderBy('name', 'asc')
            ->get(['id', 'name', 'email']); // Solo campos necesarios

        return response()->json($usuarios);
    }
}
