<?php

namespace App\Http\Controllers\AdminDenuncias;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Denuncia;
use PDF;

class ExportController extends Controller
{
    /**
     * Muestra la vista detallada de una denuncia específica para su revisión administrativa.
     * El acceso a esta función está previamente protegido por el middleware 'can:admin-denuncia-descarga'.
     */
    public function exportarExpediente($id_denuncia)
    {
        // 1. Cargar todos los datos de la denuncia
        // Asegúrate de incluir todas las relaciones necesarias para el reporte.
        $denuncia = Denuncia::with([
            'circunstancia.municipio', 
            'involucrados', 
            'testigos', 
            'archivos', 
            'contacto',
            //'estado' // Si esta relación ya existe en el modelo
        ])
        ->findOrFail($id_denuncia);

        $logoMichoacan = public_path('images/logo-mich.png');
        $logoSecoem = public_path('images/logo-secoem.png');

        // 2. Cargar la vista Blade que servirá como plantilla del PDF
        // Se utiliza la vista 'admin-denuncias.export_expediente'
        $pdf = PDF::loadView('admin-denuncias.export_expediente', compact('denuncia', 'logoMichoacan', 'logoSecoem'));

        // 3. Devolver el PDF para descarga con un nombre de archivo dinámico
        $nombreArchivo = 'Expediente_SECOEM_' . $denuncia->folio_seguimiento . '.pdf';

        return $pdf->download($nombreArchivo);
    }
}
