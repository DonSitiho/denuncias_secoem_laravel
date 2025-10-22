<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\CatEstadosRepository;

class CatEstadosController extends Controller
{
    protected $catEstadoRepo;

    public function __construct(CatEstadosRepository $catEstadoRepo)
    {
        $this->catEstadoRepo = $catEstadoRepo;
    }

    public function index()
    {
        $estados = $this->catEstadoRepo->getAll();
        return view('cat_estados.index', compact('estados'));
    }

    public function create()
    {
        return view('cat_estados.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_tipo' => 'required|integer',
            'nombre' => 'required|string|max:255',
        ]);

        $this->catEstadoRepo->create($request->only(['id_tipo', 'nombre']));

        return redirect()->route('cat_estados.index')->with('success', 'Estado creado correctamente.');
    }

    public function edit($id)
    {
        $estado = $this->catEstadoRepo->find($id);
        return view('cat_estados.edit', compact('estado'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_tipo' => 'required|integer',
            'nombre' => 'required|string|max:255',
        ]);

        $this->catEstadoRepo->update($id, $request->only(['id_tipo', 'nombre']));

        return redirect()->route('cat_estados.index')->with('success', 'Estado actualizado correctamente.');
    }

    public function destroy($id)
    {
        $this->catEstadoRepo->delete($id);
        return redirect()->route('cat_estados.index')->with('success', 'Estado desactivado.');
    }

    public function activate($id)
    {
        $this->catEstadoRepo->activate($id);
        return redirect()->route('cat_estados.index')->with('success', 'Estado activado nuevamente.');
    }
}
