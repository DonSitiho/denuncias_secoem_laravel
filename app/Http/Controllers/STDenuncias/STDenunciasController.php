<?php

namespace App\Http\Controllers\STDenuncias;

use App\Helpers\ArchivoHelper;
use App\Http\Controllers\Controller;
use App\Models\ArchivoAdjunto;
use App\Models\CatMunicipios;
use App\Models\DatosContactoDenunciante;
use App\Models\Denuncia;
use App\Models\DenunciaCircunstancia;
use App\Models\DenunciaInvolucrado;
use App\Models\DenunciaTestigo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class STDenunciasController extends Controller
{
    //
    public function index()
    {
        return view('st-denuncias.index');
    }

    /** Mostrar formulario para crear una denuncia */
    public function create()
    {

        $municipios = CatMunicipios::orderBy('nombre_municipio')->get();

        return view('st-denuncias.crear', compact('municipios'));
    }

    /** Guardar una nueva denuncia con todas sus relaciones */
    public function store(Request $request)
    {
        $request->merge([
            'es_anonima' => $request->has('es_anonima') ? 1 : 0, // Forzar 0 o 1
        ]);

        $validator = \Validator::make($request->all(), [
            'es_anonima' => 'required|in:0,1',
            'motivo_denuncia' => 'required|string',
            'fecha_hechos' => 'required|date',
            'direccion_exacta' => 'required|string',

            // Validación de aceptación de términos
            //'confirmacion_datos' => 'required|accepted',
            // Nuevos campos
            // 'programa_publico' => 'required|in:0,1',
            'nombre_programa_publico' => 'nullable|string|max:255',
            'dinero_solicitado' => 'nullable|numeric|min:0|max:9999999999.99',

            // Circunstancias opcionales
            'hora_hechos' => 'nullable|string|max:10',
            'id_municipio' => 'nullable|integer',
            'localidad' => 'nullable|string|max:255',
            'dependencia_involucrada' => 'nullable|string|max:255',
            'tramite_solicitado' => 'nullable|string|max:255',
            'circunstancias_detalladas' => 'nullable|string',

            // Arrays opcionales
            'involucrados' => 'nullable|array',
            // 'involucrados.*.estatura_aprox' => 'nullable|numeric|min:1|max:2.5',
            'testigos' => 'nullable|array',
        ]);

        // Validar campos de contacto solo si NO es anónima
        if ($request->es_anonima == 0) {
            $validator->sometimes(['nombre_completo', 'telefono', 'correo_electronico'], 'required|string|max:255', function () {
                return true; // Siempre requeridos si llegamos aquí
            });
        }

        $validator->validate();

        DB::beginTransaction();

        $ultima_denuncia = Denuncia::select('folio_seguimiento')->where('tipo_denuncia', 1)->orderBy('id_denuncia', 'desc')->first();

        $ultimo_id = $ultima_denuncia ? (int) last(explode('-', $ultima_denuncia->folio_seguimiento)) : 0;

        $folio = 'DEN-' . now()->format('Y') . '-' . str_pad($ultimo_id + 1, 6, '0', STR_PAD_LEFT);

        $denuncia = Denuncia::create([
            'folio_seguimiento' => $folio,
            'es_anonima' => $request->es_anonima,
            'fecha_recepcion' => now(),
            'motivo_denuncia' => $request->motivo_denuncia,
            'programa_publico' => $request->nombre_programa_publico,
            'dinero_solicitado' => $request->dinero_solicitado ?? 0,
            'id_estado' => 1, // Falta poner el catalogo en formulario
            'no_expediente_inter' => $request->no_expediente_inter ?? null,
            'id_dependencia_denunciada' => $request->id_dependencia_denunciada ?? null,
            'id_responsable' => $request->id_responsable ?? null,
            'token_validacion' => null,
            'clave_denunciante' => null,
            'tipo_denuncia' => 1,
            'tipo_denunciante' => 2,
        ]);

        /** 2️ Generar folio único y guardarlo */
        $denuncia->save();

        /** 3️ Guardar datos de contacto si no es anónima */
        if (!$request->es_anonima) {
            DatosContactoDenunciante::create([
                'id_denuncia' => $denuncia->id_denuncia,
                'nombre_completo' => $request->nombre_completo,
                'telefono' => $request->telefono,
                'correo_electronico' => $request->correo_electronico,
            ]);
        }

        /** 4️ Guardar circunstancias */
        //dd($request->id_municipio);
        DenunciaCircunstancia::create([
            'id_denuncia' => $denuncia->id_denuncia,
            'fecha_hechos' => $request->fecha_hechos,
            'hora_hechos' => $request->hora_hechos ?? null,
            'id_municipio' => intval($request->id_municipio) ?? null,
            'localidad' => $request->localidad ?? null,
            'direccion_exacta' => $request->direccion_exacta,
            'dependencia_involucrada' => $request->dependencia_involucrada ?? null,
            'tramite_solicitado' => $request->tramite_solicitado ?? null,
            'circunstancias_detalladas' => $request->circunstancias_detalladas ?? null,
        ]);

        /** 5️ Guardar involucrados (si existen) */
        if ($request->has('involucrados') && is_array($request->involucrados)) {
            foreach ($request->involucrados as $i) {
                //dd($i['estatura_aprox']);
                DenunciaInvolucrado::create([
                    'id_denuncia' => $denuncia->id_denuncia,
                    'es_servidor_publico' => $i['es_servidor_publico'] ?? 0,
                    'nombre_denunciado' => $i['nombre_denunciado'] ?? null,
                    'puesto_denunciado' => $i['puesto_denunciado'] ?? null,
                    'sexo' => $i['sexo'] ?? null,
                    'tez' => $i['tez'] ?? null, // Nuevo campo
                    'estatura_aprox' => $i['estatura_aprox'] ?? null, // Nuevo campo
                    'edad_aprox' => $i['edad_aprox'] ?? null,
                    'complexion' => $i['complexion'] ?? null, // Nuevo campo
                    'color_ojos' => $i['color_ojos'] ?? null, // Nuevo campo
                    'tipo_cabello' => $i['tipo_cabello'] ?? null, // Nuevo campo
                    'senas_particulares' => $i['senas_particulares'] ?? null, // Nuevo campo
                    'descripcion_fisica' => $i['descripcion_fisica'] ?? null,
                ]);
            }
        }

        /** 6️ Guardar testigos (si existen) */
        if ($request->has('testigos') && is_array($request->testigos)) {
            foreach ($request->testigos as $t) {
                DenunciaTestigo::create([
                    'id_denuncia' => $denuncia->id_denuncia,
                    'tiene_testigos' => 1,
                    'nombre_testigo' => $t['nombre_testigo'] ?? null,
                    'datos_contacto' => $t['datos_contacto'] ?? null,
                    'observaciones' => $t['observaciones'] ?? null,
                ]);
            }
        }

        //VERIFICAR SI LLEGO ARCHIVO depues encryptarlo y almacenarlo(uso de helper) composer dump-autoload
        if ($request->hasFile('archivos')) {
            foreach ($request->file('archivos') as $archivo) {
                $resultado = ArchivoHelper::guardarArchivoEncriptado($archivo);

                if ($resultado) {
                    ArchivoAdjunto::create([
                        'id_denuncia' => $denuncia->id_denuncia,
                        'nombre_original' => $resultado['nombre'],
                        'tipo_archivo' => $resultado['categoria'],
                        'ruta_cifrada' => $resultado['ruta'],
                        'fecha_carga' => now(),
                    ]);
                } else {
                    return back()->with('error', 'No se pudo guardar el archivo: ' . $archivo->getClientOriginalName());
                }
            }
        }

        DB::commit();

        return redirect()
            ->route('admin.denuncias.index')
            ->with('success', 'Denuncia capturada correctamente.');
    }

    /** Agregar el folio interno CED a una denuncia */
    public function agregarFolioCED(Request $request, int $id_denuncia)
    {
        $request->validate([
            'folio_ced' => 'required|string'
        ]);

        try {
            DB::beginTransaction();
            $denuncia = Denuncia::findOrFail($id_denuncia);

            $denuncia->folio_interno = $request->folio_ced;
            $denuncia->save();

            DB::commit();

            return redirect()->route('admin.denuncias.show', $id_denuncia)
                ->with('success', 'El folio interno de la denuncia se asignó correctamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Ocurrió un error al asignar el folio interno. Inténtelo nuevamente.');
        }
    }
}
