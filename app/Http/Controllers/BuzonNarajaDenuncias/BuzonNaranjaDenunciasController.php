<?php

namespace App\Http\Controllers\BuzonNarajaDenuncias;

use App\Http\Controllers\Controller;
use App\Models\BuzonNarajaDenuncia;
use Illuminate\Http\Request;

class BuzonNaranjaDenunciasController extends Controller
{
    public function getDenunciasNuevas() {}

    public function getDenunciasHistorial()
    {

        return view('buzon-naranja-denuncias.historial.index');
    }

    public function verDetallesDenunciaHistorial($id_denuncia){

        $denuncia = BuzonNarajaDenuncia::with(['municipio'])->findOrFail($id_denuncia);

        //return json_encode($denuncia);

        return view('buzon-naranja-denuncias.historial.detalles-denuncia-historial', compact('denuncia'));

    }
}
