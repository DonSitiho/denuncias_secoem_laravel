<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\{
    Denuncia,
    DenunciaCircunstancia,
    DatosContactoDenunciante,
    DenunciaInvolucrado,
    DenunciaTestigo,
    CatMunicipios
};
use Carbon\Carbon;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
//use Illuminate\Support\Facades\PDF;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str;
use App\Helpers\ArchivoHelper;
use App\Models\ArchivoAdjunto;



class DenunciaController extends Controller
{
    /** Página de inicio */
    public function inicio()
    {
        return view('denuncias.inicio');
    }

    /** Mostrar formulario para crear una denuncia */
    public function create()
    {
        $municipios = CatMunicipios::orderBy('nombre_municipio')->get();

        return view('denuncias.crear', compact('municipios'));
    }

    /** Guardar una nueva denuncia con todas sus relaciones */
    public function store(Request $request)
    {
        //dd($request->all());
        // Validación del request

        $request->validate([
            'es_anonima' => 'required|in:0,1', // Cambiar de boolean a in:0,1
            'motivo_denuncia' => 'required|string',
            'fecha_hechos' => 'required|date',
            'direccion_exacta' => 'required|string',

            //     // Datos de contacto solo si NO es anónima
            'nombre_completo' => 'required_if:es_anonima,0|string|max:255', // Cambiar false por 0
            'telefono' => 'required_if:es_anonima,0|string|max:20', // Cambiar false por 0
            'correo_electronico' => 'required_if:es_anonima,0|email|max:255', // Cambiar false por 0

            // Circunstancias opcionales - algunos campos en tu form están como required pero en validación son nullable
            'hora_hechos' => 'nullable|string|max:10',
            'id_municipio' => 'nullable|integer',
            'localidad' => 'nullable|string|max:255',
            'dependencia_involucrada' => 'nullable|string|max:255',
            'tramite_solicitado' => 'nullable|string|max:255',
            'circunstancias_detalladas' => 'nullable|string', // En tu form está como required

            // Arrays opcionales
            'involucrados' => 'nullable|array',
            'testigos' => 'nullable|array',
        ]);
        //dd($request->all());


        DB::beginTransaction();

        //try {
        /** 1️ Crear denuncia principal sin folio aún */
        //ver el id de la ultima denuncia
        $id_ultima_denuncia = Denuncia::select('id_denuncia')->orderBy('id_denuncia', 'desc')->first();

        $ultimo_id = $id_ultima_denuncia ? $id_ultima_denuncia->id_denuncia : 0;

        $folio = 'DEN-' . now()->format('Y') . '-' . str_pad($ultimo_id + 1, 6, '0', STR_PAD_LEFT);

        //Generar token de validación único
        $codigo = Str::upper(Str::random(5)); // Ej: "A1B2C"

        $denuncia = Denuncia::create([
            'folio_seguimiento' => $folio,
            'es_anonima' => $request->es_anonima,
            'fecha_recepcion' => now(),
            'motivo_denuncia' => $request->motivo_denuncia,
            'programa_publico' => $request->programa_publico,
            'dinero_solicitado' => $request->dinero_solicitado ?? 0,
            'id_estado' => 1, // Falta poner el catalogo en formulario
            'no_expediente_inter' => $request->no_expediente_inter ?? null,
            'id_dependencia_denunciada' => $request->id_dependencia_denunciada ?? null,
            'id_responsable' => $request->id_responsable ?? null,
            'token_validacion' => $codigo,

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

        /** 7️ Generar QR en base64 para la vista */
        // Agregar propiedades computadas para la vista
        // $denuncia->estado_color = match($denuncia->estado) {
        //     'Registrada' => 'primary',
        //     'En Revisión' => 'warning',
        //     'En Proceso' => 'info',
        //     'Resuelta' => 'success',
        //     'Cerrada' => 'danger',
        //     default => 'secondary'
        // };
        $url = route('denuncias.seguimiento', $folio);
        $qrCode = QrCode::format('svg')->size(100)->generate($url);

        /** 8️ Retornar vista de confirmación */
        return view('denuncias.confirmacion', compact('folio', 'codigo', 'qrCode'));
        // } catch (\Throwable $e) {
        //     DB::rollBack();
        //     return back()->withErrors(['error' => 'Error al registrar la denuncia: ' . $e->getMessage()]);
        // }
    }

    public function seguimiento($folio)
    {
        $denuncia = Denuncia::with(['municipio', 'seguimientos'])
            ->where('folio', $folio)
            ->firstOrFail();

        // Agregar propiedades computadas para la vista
        $denuncia->estado_color = match ($denuncia->estado) {
            'Registrada' => 'primary',
            'En Revisión' => 'warning',
            'En Proceso' => 'info',
            'Resuelta' => 'success',
            'Cerrada' => 'danger',
            default => 'secondary'
        };

        return view('denuncias.seguimiento', compact('denuncia'));
    }


    /** Buscar denuncia */
    public function buscar()
    {
        return view('denuncias.buscar');
    }

    public function buscarDenunciaFolio(Request $request)
    {
        try {
            // Validar datos manualmente para evitar redirección HTML
            $validated = $request->validate([
                'folio' => 'required|string',
                'codigo' => 'required|string|size:5',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Datos inválidos o incompletos.',
                'errors' => $e->errors(),
            ], 422);
        }

        // Buscar la denuncia con folio y código
        $denuncia = Denuncia::where('folio_seguimiento', $validated['folio'])
            ->where('token_validacion', $validated['codigo'])
            ->first();
        // Encriptar el ID de la denuncia
        $id_denuncia_cifrada = encrypt($denuncia->id_denuncia);
        if ($denuncia) {
            return response()->json([
                'success' => true,
                'redirect_url' => route('denuncias.show', $id_denuncia_cifrada),
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'No se encontró ninguna denuncia con el folio y código proporcionados.',
        ], 404);
    }

    public function show($id_denuncia_cifrada)
    {
        try {
        // Desencriptar token recibido
        $id_denuncia = decrypt($id_denuncia_cifrada);
        } catch (\Exception $e) {
            //fue manipulado
            return response()->view('denuncias.error.404', [
                'message' => 'Token de seguridad inválido o alterado.'
            ], 401);
        }
        // Cargar relaciones necesarias
        $denuncia = Denuncia::with([
            'contacto',
            'involucrados',
            'testigos',
            'circunstancia.municipio',
            'archivos'
        ])->where('id_denuncia', $id_denuncia)->firstOrFail();

        return view('denuncias.show', compact('denuncia'));
    }

    public function verificarPalabraClave(Denuncia $denuncia, Request $request)
    {
        $request->validate([
            'token_validacion' => 'required|string'
        ]);

        // Asumiendo que tienes un campo 'palabra_clave' en tu modelo Denuncia
        // if ($denuncia->palabra_clave === $request->palabra_clave) {
        //dd($denuncia->token_validacion);
        if ($denuncia->token_validacion === $request->token_validacion) {
            return response()->json([
                'success' => true,
                'message' => 'Palabra clave correcta'
            ]);
        }
        

        return response()->json([
            'success' => false,
            'message' => 'La palabra clave ingresada es incorrecta'
        ], 401);
    }

    public function detallesCompletos(Denuncia $denuncia)
    {
        // Cargar todas las relaciones para los detalles completos
        $denuncia = Denuncia::with([
            'contacto',
            'involucrados',
            'testigos',
            'circunstancia.municipio',
            'archivos'
        ])->where('id_denuncia', $denuncia->id_denuncia)->firstOrFail();

        // Datos individuales
        $datosContactoDenunciante = $denuncia->contacto;
        $datosCircunstancia = $denuncia->circunstancia;
        $datosMunicipio = $datosCircunstancia->municipio ?? null;

        $data = [
            'denuncia' => $denuncia,
            'fechaActual' => now()->format('d/m/Y H:i'),
            'datosContactoDenunciante' => $datosContactoDenunciante,
            'datosDenunciaInvolucrado' => $denuncia->involucrados,
            'datosTestigos' => $denuncia->testigos,
            'datosCircunstancia' => $datosCircunstancia,
            'datosMunicipio' => $datosMunicipio,
        ];

        // Retornar la vista como HTML
        $html = view('denuncias.partials.detalles-completos', $data)->render();

        return response()->json([
            'success' => true,
            'html' => $html
        ]);
    }

    public function generarPDF($folio)
    {
        // Cargar denuncia con todas las relaciones necesarias
        $denuncia = Denuncia::with([
            'contacto',
            'involucrados',
            'testigos',
            'circunstancia.municipio',
            'archivos'
        ])->where('folio_seguimiento', $folio)->firstOrFail();

        // Datos individuales
        $datosContactoDenunciante = $denuncia->contacto;
        $datosCircunstancia = $denuncia->circunstancia;
        $datosMunicipio = $datosCircunstancia->municipio ?? null;

        // Generar QR en SVG
        $urlSeguimiento = route('denuncias.seguimiento', $folio);
        $qrCode = QrCode::format('svg')->size(200)->generate($urlSeguimiento);

        // Datos para la vista
        $data = [
            'denuncia' => $denuncia,
            'qrCode' => base64_encode($qrCode), // SVG codificado en base64
            'fechaActual' => now()->format('d/m/Y H:i'),
            'datosContactoDenunciante' => $datosContactoDenunciante,
            'datosDenunciaInvolucrado' => $denuncia->involucrados,
            'datosTestigos' => $denuncia->testigos,
            'datosCircunstancia' => $datosCircunstancia,
            'datosMunicipio' => $datosMunicipio,
        ];

        // Generar PDF
        $pdf = PDF::loadView('denuncias.comprobante-pdf', $data);
        $pdf->setPaper('letter', 'portrait');
        $pdf->setOption('defaultFont', 'Arial');
        $pdf->setOption('isHtml5ParserEnabled', true);
        $pdf->setOption('isRemoteEnabled', true);

        // Descargar PDF
        return $pdf->download("comprobante-denuncia-{$folio}.pdf");
    }
}
