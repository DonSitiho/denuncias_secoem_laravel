<?php

namespace App\Http\Controllers\AdminDenuncias;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Denuncia;
use App\Models\DocDenuncias;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use App\Models\ArchivoAdjunto;
use Illuminate\Support\Facades\Storage; // Necesario para gestionar archivos

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
        ])
        ->findOrFail($id_denuncia);

        return view('admin-denuncias.show', compact('denuncia'));
    }

    /**
     * Acción POST para turnar la denuncia a un Usuario OIC.
     */
    public function turnar(Request $request, $id_denuncia)
    {
        // El middleware 'can:admin-denuncia-turnar' ya protegió el acceso.
        
        $request->validate(['id_responsable' => 'required|integer']);

        try {
            DB::beginTransaction();

            $docDenuncia = Denuncia::where('id_denuncia', $id_denuncia)->firstOrFail();
            
            $docDenuncia->id_responsable = $request->id_responsable;
            $docDenuncia->id_estado = 2; // Asumir '2' es 'Turnada'
            $docDenuncia->momento = now();
            $docDenuncia->save();
            
            DB::commit();

            return redirect()->route('admin.denuncias.show', $id_denuncia)
                            ->with('success', 'Denuncia turnada exitosamente al OIC responsable.');

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error("Error al turnar denuncia: " . $e->getMessage());
            return redirect()->back()->with('error', 'Fallo al realizar el turno. Intente de nuevo.');
        }
    }
    
    /**
     * Descarga de Evidencia Temporal (Sin Cifrado).
     */
    public function descargarEvidencia($id_archivo)
    {
        // El middleware 'can:admin-denuncia-descarga' ya protegió el acceso.
        
        $archivo = ArchivoAdjunto::with('denuncia')->findOrFail($id_archivo);

        // 1. Verificación de Permisos Lógicos (D3): Si la denuncia es visible para el Admin.
        // if (Gate::denies('view', $archivo->denuncia)) { ... } 
        
        // 2. Lógica TEMPORAL sin cifrado (Descarga directa del disco)
        $rutaCompleta = $archivo->ruta_cifrada; // Usamos este campo temporalmente como la ruta no cifrada.

        if (!Storage::disk('denuncias_storage')->exists($rutaCompleta)) {
            return redirect()->back()->with('error', 'El archivo no fue encontrado en el servidor.');
        }

        // Devolvemos la descarga del archivo. 
        // Nota: 'denuncias_storage' debe estar configurado en config/filesystems.php
        return Storage::disk('denuncias_storage')->download($rutaCompleta, $archivo->nombre_original);
    }
}