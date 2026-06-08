<?php

namespace App\Http\Controllers\BuzonNarajaDenuncias;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BuzonNaranjaDenunciasController extends Controller
{
    public function getDenunciasNuevas(){

        

    }

    public function getDenunciasHistorial(){
        
        return view('buzon-naranja-denuncias.historial.index');

    }
}
