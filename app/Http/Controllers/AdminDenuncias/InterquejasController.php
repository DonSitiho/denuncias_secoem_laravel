<?php

namespace App\Http\Controllers\AdminDenuncias;

use App\Http\Controllers\Controller;
use App\Models\Interqueja;
use Illuminate\Http\Request;

class InterquejasController extends Controller
{
    //

    public function index () {
        
        return view('admin-denuncias.interquejas.index');

    }

    public function show($id_denuncia) {

        $interqueja = Interqueja::with(['municipio_hecho'])->findOrFail($id_denuncia);

        return view('admin-denuncias.interquejas.show', compact('interqueja'));

    }

}
