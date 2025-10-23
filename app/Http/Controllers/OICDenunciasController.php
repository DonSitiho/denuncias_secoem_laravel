<?php

namespace App\Http\Controllers;

use App\Models\Denuncia;
use App\Repositories\DenunciasRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OICDenunciasController extends Controller
{
    //
    protected $denunciasOICRepo;

    public function __construct(DenunciasRepository $denunciasOICRepo)
    {
        $this->denunciasOICRepo = $denunciasOICRepo;
    }

    public function getMisDenuncias(){
        
        $this->authorize('viewAny', Denuncia::class);
        $user = Auth::user();

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

        $denuncia = Denuncia::findOrFail($id_denuncia);

        $this->authorize('view', $denuncia);

        return json_encode("holaaaaaaaaaaaaaaa");

    }

    public function descargarDenuncia($id_denuncia){

    }

}
