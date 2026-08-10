<?php

namespace App\Http\Controllers\UAOICDenuncias;

use App\Helpers\ArchivoHelper;
use App\Http\Controllers\Controller;
use App\Models\ArchivoAdjunto;
use App\Models\Area;
use App\Models\Denuncia;
use App\Models\DenunciaTurnadoHistorial;
use App\Models\SolventarInfo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use PhpParser\Node\Stmt\TryCatch;

class UAOICDenunciasController extends Controller
{
    //

    public function getMisDenuncias()
    {
        return view('uaoic-denuncias.index');
    }

    public function getMisDenunciasBN() 
    {
        return view('uaoic-denuncias.buzon-naranja.index');
    }

    public function show($id_denuncia)
    {

        $denuncia = Denuncia::with([
             'circunstancia', // Carga los detalles de ubicación, fecha y dependencia
            'involucrados',  // Carga la lista de personas denunciadas y su descripción física
            'testigos',      // Carga los datos de los testigos
            'archivos',      // Carga los metadatos de las evidencias adjuntas
            'contacto',      // Carga el nombre, teléfono y correo del denunciante (si no es anónima)
            'solventarInfo'  // Cargar los detalles de la infomarcion solicita al denunciante 
        ])->findOrFail($id_denuncia);

        $areaResponsable = Area::where('is_active', true)->whereBetween('id_area', [6, 17])->get();

        $usuariosOIC = User::where('is_active', true)->whereBetween('id_area', [6, 17])->get();

        $tipoCampos = SolventarInfo::TIPOCAMPO;

        $tipo = $denuncia->tipo_denuncia;
        
        if ($tipo == 1) {
            return view('uaoic-denuncias.show', compact('denuncia', 'tipoCampos', 'areaResponsable', 'usuariosOIC' ));
        } elseif ($tipo == 2) {
            return view('uaoic-denuncias.buzon-naranja.show', compact('denuncia', 'tipoCampos', 'areaResponsable', 'usuariosOIC'));
        }

    }

    public function turnarDenunciaOIC(Request $request, $id_denuncia)
    {
        $request->validate([
            'id_area_responsable' => 'required|integer|exists:areas,id_area', // Área es OBLIGATORIA
            'id_responsable' => 'nullable|integer|exists:users,id', // Usuario específico es OPCIONAL
        ]);

        try {
            //code..
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

            DB::commit();
            return redirect()->route('uaoic.show', $id_denuncia)->with('success', 'Denuncia turnada exitosamente al OIC responsable.');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Error al turnar la denuncia: " . $e->getMessage());
            return redirect()->back()->with('error', 'Fallo al realizar el turno. Intente de nuevo.');
        }
    }

    public function descargarDenuncia($id_archivo) 
    {
        try {
            $archivo = ArchivoAdjunto::with('denuncia')->findOrFail($id_archivo);

            // Aseguramos que el usuario logueado tenga derecho a ver esta denuncia específica.
            if (Gate::denies('uaoic-denuncia-descarga')) {
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

    public function solvetarInformacionDenuncia(Request $request, $id_denuncia)
    {
        // 1. VALIDACIÓN ACTUALIZADA
        $request->validate([
            'observacion_responsable' => 'required|string',
            'tipo_campo' => 'required',
        ]);

        try {
            DB::beginTransaction();
            $denuncia = Denuncia::findOrFail($id_denuncia);
            $user = Auth::user();

            $solventarInfo = SolventarInfo::create([
                'id_denuncia' => $denuncia->id_denuncia,
                'id_usuario_solicito' => $user->id,
                'id_area_responsable' => $user->id_area,
                'observacion_responsable' => $request->observacion_responsable,
                'tipo_campo' => $request->tipo_campo,
                'info_solicitada' => null,
                'fecha_solicitud_info' => now(),
            ]);

            $solventarInfo->save();
            DB::commit();

            return redirect()->route('uaoic.show', $id_denuncia)
                ->with('success', 'Se solicitó información adicional al denunciante de manera exitosa.');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Error al solicitar mas informacion de la denuncia: " . $e->getMessage());
            return redirect()->back()->with('error', 'Ocurrió un error al solicitar información adicional. Inténtelo nuevamente.');
        }
    }
}
