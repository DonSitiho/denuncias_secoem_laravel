<?php

namespace App\Http\Controllers\AdminDenuncias;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Denuncia;
use PDF;
use setasign\Fpdi\Tcpdf\Fpdi;

class ExportController extends Controller
{
    /**
     * Muestra la vista detallada de una denuncia específica para su revisión administrativa.
     * El acceso a esta función está previamente protegido por el middleware 'can:admin-denuncia-descargar'.
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
        $usuario = auth()->user()->name;

        // 2. Cargar la vista Blade que servirá como plantilla del PDF
        // Se utiliza la vista 'admin-denuncias.export_expediente'
        // Render "base" (sin hash) para calcular el hash del contenido
        $datosBase = compact('denuncia', 'logoMichoacan', 'logoSecoem', 'usuario');
        $pdf = PDF::loadView('admin-denuncias.export_expediente', $datosBase + ['hash' => null]);
        $hash = hash('sha256', $pdf->output());

        // 3. Render final, ahora sí con el hash inyectado en la vista
        $pdfFinal = PDF::loadView('admin-denuncias.export_expediente', $datosBase + ['hash' => $hash]);

        // 4. La marca de agua con FPDI (esto sí se hace sobre el PDF ya renderizado)
        $rutaTemporal = storage_path('app/temp_expediente_' . uniqid() . '.pdf');
        file_put_contents($rutaTemporal, $pdfFinal->output());

        $fpdi = new Fpdi();
        $fpdi->setPrintHeader(false);
        $fpdi->setPrintFooter(false);

        $totalPaginas = $fpdi->setSourceFile($rutaTemporal);

        for ($i = 1; $i <= $totalPaginas; $i++) {
            $tplId  = $fpdi->importPage($i);
            $size = $fpdi->getTemplateSize($tplId);

            $fpdi->AddPage($size['orientation'], [$size['width'], $size['height']]);
            $fpdi->useTemplate($tplId);

            $fpdi->SetAlpha(0.15);
            $fpdi->SetFont('dejavusans', 'B', 30);
            $fpdi->SetTextColor(130, 130, 130);

            $fpdi->StartTransform();
            $fpdi->Rotate(45, $size['width'] / 2, $size['height'] / 2);
            $fpdi->Text($size['width'] / 2 - 50, $size['height'] / 2, $usuario);
            $fpdi->StopTransform();

            $fpdi->SetAlpha(1);
        }

        $contenidoFinal = $fpdi->Output('', 'S');
        unlink($rutaTemporal);

        // 5. Devolver el PDF para descarga con un nombre de archivo dinámico
        $nombreArchivo = 'Expediente_SECOEM_' . $denuncia->folio_seguimiento . '.pdf';

        //return $pdf->download($nombreArchivo);

        return response($contenidoFinal, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="' . $nombreArchivo . '"',
            'Content-Length' => strlen($contenidoFinal),
        ]);
    }
}
