<?php

namespace App\Http\Controllers\UAOICDenuncias;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Denuncia;
use App\Models\DenunciaTurnadoHistorial;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

        $tipo = $denuncia->tipo_denuncia;
        
        if ($tipo == 1) {
            return view('uaoic-denuncias.show', compact('denuncia', 'areaResponsable', 'usuariosOIC' ));
        } elseif ($tipo == 2) {
            return view('uaoic-denuncias.buzon-naranja.show', compact('denuncia', 'areaResponsable', 'usuariosOIC'));
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

    public function descargarDenuncia($id_denuncia) 
    {

    }
}
