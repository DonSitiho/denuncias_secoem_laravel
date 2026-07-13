<?php

namespace App\Http\Controllers\BuzonNarajaDenuncias;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\BuzonNarajaDenuncia;
use App\Models\Denuncia;
use App\Models\DenunciaTurnadoHistorial;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BuzonNaranjaDenunciasController extends Controller
{
    public function getDenunciasNuevas()
    {
        return view('buzon-naranja-denuncias.index');
    }

    public function getDenunciasHistorial()
    {

        return view('buzon-naranja-denuncias.historial.index');
    }


    public function verDetallesDenuncias($id_denuncia)
    {
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

        $areaResponsable = Area::where('is_active', true)->where('id_area', 3)->get();
        
        // Cargar usuarios que tienen asignado un id_area en la tabla users
        $usuariosUAOIC = User::where('id_area', 3)
            ->where('is_active', true)
            ->orderBy('name', 'asc')
            ->get();


        return view('buzon-naranja-denuncias.show', compact('denuncia', 'areaResponsable', 'usuariosUAOIC'));
    }

    public function verDetallesDenunciaHistorial($id_denuncia)
    {

        $denuncia = BuzonNarajaDenuncia::with(['municipio'])->findOrFail($id_denuncia);

        //return json_encode($denuncia);

        return view('buzon-naranja-denuncias.historial.detalles-denuncia-historial', compact('denuncia'));
    }


    public function turnarDenuncia(Request $request, $id_denuncia){

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

            return redirect()->route('buzon-naranja.denuncias.show', $id_denuncia)->with('success', 'Denuncia turnada exitosamente al área responsable.');
            
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error("Error al turnar denuncia: " . $e->getMessage());
            return redirect()->back()->with('error', 'Fallo al realizar el turno. Intente de nuevo.');
        }
    }
}
