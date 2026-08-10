<?php

namespace App\Http\Controllers;

use App\Helpers\ArchivoHelper;
use App\Models\ArchivoAdjunto;
use App\Models\Area;
use App\Models\Denuncia;
use App\Models\DenunciaTurnadoHistorial;
use App\Models\SolventarInfo;
use App\Models\User;
use App\Repositories\DenunciasRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use PhpParser\Node\Stmt\TryCatch;

class OICDenunciasController extends Controller
{
    /*
    protected $denunciasOICRepo;

    public function __construct(DenunciasRepository $denunciasOICRepo)
    {
        $this->denunciasOICRepo = $denunciasOICRepo;
    }
    */
    public function getMisDenuncias()
    {

        $this->authorize('viewAny', Denuncia::class);
        //$user = Auth::user();

        //$denuncias = Denuncia::where('id_responsable_secoem', '=', $user->id)->get();
        //$denuncias = Denuncia::denunciasResponsable($user->id)->get();

        //$denuncias = $this->denunciasOICRepo->denunciasPorResponsable($user->id);

        return view('oic-denuncias.index');
    }

    public function getMisDenunciasBN()
    {

        return View('oic-denuncias.buzon-naranja.index');
    }

    /**
     * Muestra la Vista Detalle de una Denuncia específica.
     */
    public function verDetallesDenuncia($id_denuncia)
    {

        $denuncia = Denuncia::with([
            'circunstancia', // Carga los detalles de ubicación, fecha y dependencia
            'involucrados',  // Carga la lista de personas denunciadas y su descripción física
            'testigos',      // Carga los datos de los testigos
            'archivos',      // Carga los metadatos de las evidencias adjuntas
            'contacto',      // Carga el nombre, teléfono y correo del denunciante (si no es anónima)
            'solventarInfo'  // Cargar los detalles de la infomarcion solicita al denunciante 
        ])
            ->findOrFail($id_denuncia);


        $usuario = auth()->user();

        $areaResponsable = Area::where('is_active', true)->where('id_area_padre', $usuario->id_area)->get();

        //$usuariosOIC = User::where('is_active', true)->offset(4)->limit(10)->get();


        $usuariosOIC = User::where('is_active', true)->whereIn('id_area', $areaResponsable->pluck('id_area'))->get();

        //return json_encode($usuarios);


        //return json_encode($denuncia->tipo_denuncia);

        // Aplicar politica para la denuncia sea visualizada unicamente por el responsable al que se le turno la denuncia.
        $this->authorize('view', $denuncia);

        $tipoCampos = SolventarInfo::TIPOCAMPO;

        /**
         * Muestra la vista detallada de una denuncia específica para su revisión administrativa.
         * Carga las relaciones directas que contienen la información de captura del ciudadano.
         * * El acceso a esta función está previamente protegido por el middleware 'can:oic-denuncia-detalles'.
         */

        if ($denuncia->tipo_denuncia == 1) {
            return view('oic-denuncias.detalles-denuncia', compact('denuncia', 'tipoCampos', 'areaResponsable', 'usuariosOIC'));
        } else if ($denuncia->tipo_denuncia == 2) {
            return view('oic-denuncias.buzon-naranja.detalles', compact('denuncia', 'tipoCampos', 'areaResponsable', 'usuariosOIC'));
        }
    }


    public function turnarDenunciaOIC(Request $request, $id_denuncia)
    {

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

            DB::commit();

            //return redirect()->route('buzon-naranja.denuncias.show', $id_denuncia)->with('success', 'Denuncia turnada exitosamente al área responsable.');
            return redirect()->route('oic.ver-denuncia', $id_denuncia)->with('success', 'Denuncia turnada exitosamente al OIC responsable.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Error al turnar la denuncia: " . $e->getMessage());
            return redirect()->back()->with('error', 'Fallo al realizar el turno. Intente de nuevo.');
        }
    }


    /**
     * Descarga de Archivo de Evidencia de la Denuncia Temporal (Sin Cifrado).
     */

    public function descargarEvidenciaDenuncia($id_archivo)
    {

        try {
            $archivo = ArchivoAdjunto::with('denuncia')->findOrFail($id_archivo);

            // Aseguramos que el usuario logueado tenga derecho a ver esta denuncia específica.
            if (Gate::denies('oic-denuncia-descargar')) {
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

        // El middleware 'can:oic-denuncia-solventar-info' ya protegió el acceso.

        // 1. VALIDACIÓN ACTUALIZADA
        $request->validate([
            'observacion_responsable' => 'required|string', // Observacion es OBLIGATORIA
            'tipo_campo' => 'required', // Tipo de campo específico es OBLIGATORIA
        ]);

        try {
            DB::beginTransaction();
            $denuncia = Denuncia::findOrFail($id_denuncia);
            $user = $user = Auth::user();

            $solventarInfo = SolventarInfo::create([
                'id_denuncia' => $denuncia->id_denuncia,
                'id_usuario_solicito' => $user->id,
                'id_area_responsable' => $user->id_area,
                'observacion_responsable' => $request->observacion_responsable,
                'tipo_campo' => $request->tipo_campo,
                'info_solicitada' => null,
                'fecha_solicitud_info' => now(),
                ''
            ]);

            $solventarInfo->save();

            DB::commit();

            //return json_encode($denuncia);

            return redirect()->route('oic.ver-denuncia', $id_denuncia)
                ->with('success', 'Se solicitó información adicional al denunciante de manera exitosa.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Error al solicitar mas informacion de la denuncia: " . $e->getMessage());
            return redirect()->back()->with('error', 'Ocurrió un error al solicitar información adicional. Inténtelo nuevamente.');
        }
    }

    /*
    public function denunciaEnTramite($id_denuncia){

        // El middleware 'can:oic-denuncia-tramite' ya protegió el acceso.

        try {

            DB::beginTransaction();

            // Buscar el registro
            $denuncia = Denuncia::findOrFail($id_denuncia);

            // Cambiar el estatus (ajusta el nombre del campo según tu tabla)
            $denuncia->id_estado = 3;
            $denuncia->save();

            DB::commit();

        } catch (\Exception $e){

        }
    }
    */
}
