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
        
        $denuncias = DocDenuncias::with('denuncia', 'estado')
            ->orderBy('fecha_recepcion', 'desc')
            ->paginate(15);
            
        return view('admin-denuncias.index', compact('denuncias'));
    }

    /**
     * Muestra la Vista Detalle de una Denuncia específica.
     */
    public function show($id_denuncia)
    {
        // El middleware 'can:admin-denuncia-ver' ya protegió el acceso.
        
        $denuncia = Denuncia::with([
            'circunstancia.municipio', 
            'involucrados', 
            'testigos', 
            'archivos', 
            'contacto',
            'seguimiento'
        ])->findOrFail($id_denuncia);

        return view('admin-denuncias.show', compact('denuncia'));
    }

    /**
     * Acción POST para turnar la denuncia a un Usuario OIC.
     */
    public function turnar(Request $request, $id_denuncia)
    {
        // El middleware 'can:admin-denuncia-turnar' ya protegió el acceso.
        
        $request->validate(['id_responsable_secoem' => 'required|integer']);

        try {
            DB::beginTransaction();

            $docDenuncia = DocDenuncias::where('id_denuncia', $id_denuncia)->firstOrFail();
            
            $docDenuncia->id_responsable_secoem = $request->id_responsable_secoem;
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