<?php

namespace App\Http\Controllers;

use App\Repositories\DenunciasRepository;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    protected $denunciasOICRepo;

    public function __construct(DenunciasRepository $denunciasOICRepo)
    {
        $this->denunciasOICRepo = $denunciasOICRepo;
    }


    public function index()
    {
        if(Auth::check()){
            $user = Auth::user();
            $role = $user->roles->first();
            if($role->id == 7){
                return $this->indexIOC();
            }
        }
        addVendors(['amcharts', 'amcharts-maps', 'amcharts-stock']);
        return view('pages/dashboards.index');
    }

    public function indexIOC(){

        $totalDenunciasArea = $this->denunciasOICRepo->totalDenunciaAreaResponsable();
        $totalDenunciasTurnadaResponsable = $this->denunciasOICRepo->totalDenunciasTurnadasResponsable();

        //return json_encode($totalDenunciasTurnadaResponsable);

        return view('pages/dashboards.indexOIC', compact('totalDenunciasArea', 'totalDenunciasTurnadaResponsable'));

    }
}
