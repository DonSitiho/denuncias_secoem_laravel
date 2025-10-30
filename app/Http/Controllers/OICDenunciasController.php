<?php

namespace App\Http\Controllers;

use App\Helpers\ArchivoHelper;
use App\Models\ArchivoAdjunto;
use App\Models\Denuncia;
use App\Repositories\DenunciasRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OICDenunciasController extends Controller
{
    /*
    protected $denunciasOICRepo;

    public function __construct(DenunciasRepository $denunciasOICRepo)
    {
        $this->denunciasOICRepo = $denunciasOICRepo;
    }
    */
    public function getMisDenuncias(){
        
        $this->authorize('viewAny', Denuncia::class);
        //$user = Auth::user();

        //$denuncias = Denuncia::where('id_responsable_secoem', '=', $user->id)->get();
        //$denuncias = Denuncia::denunciasResponsable($user->id)->get();

        //$denuncias = $this->denunciasOICRepo->denunciasPorResponsable($user->id);

        //return json_encode($denuncias);

        return view('oic-denuncias.index');

    }

    /**
     * Muestra la Vista Detalle de una Denuncia específica.
     */
    public function verDetallesDenuncia($id_denuncia){
    
        $denuncia = Denuncia::with([
            'circunstancia', // Carga los detalles de ubicación, fecha y dependencia
            'involucrados',  // Carga la lista de personas denunciadas y su descripción física
            'testigos',      // Carga los datos de los testigos
            'archivos',      // Carga los metadatos de las evidencias adjuntas
            'contacto',      // Carga el nombre, teléfono y correo del denunciante (si no es anónima)
        ])
        ->findOrFail($id_denuncia);

        //return json_encode($denuncia);

        // Aplicar politica para la denuncia sea visualizada unicamente por el responsable al que se le turno la denuncia.
        $this->authorize('view', $denuncia);

        /**
         * Muestra la vista detallada de una denuncia específica para su revisión administrativa.
         * Carga las relaciones directas que contienen la información de captura del ciudadano.
         * * El acceso a esta función está previamente protegido por el middleware 'can:oic-denuncia-detalles'.
         */
        
        return view('oic-denuncias.detalles-denuncia', compact('denuncia'));

            
    }


    /**
     * Descarga de Archivo de Evidencia de la Denuncia Temporal (Sin Cifrado).
     */

    public function descargarEvidenciaDenuncia($id_archivo){

        $denuncia = Denuncia::findOrFail($id_archivo);

        // Aplicar la politica para que la denuncia sea descargada unicamente por el responsable al que se le turno la denuncia.
        $this->authorize('view', $denuncia);

        $archivo = ArchivoAdjunto::findOrFail($denuncia->id_denuncia);

        $ruta = $archivo->ruta_cifrada;
        $nombreArchivo = $archivo->nombre_original;
        $tipoMime = mime_content_type(storage_path('app/' . $ruta));
        $descargar = true; 

        return ArchivoHelper::descargarArchivoEncriptado($ruta, $nombreArchivo, $tipoMime, $descargar);

    }

}
