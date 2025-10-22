<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\CatMunicipioRepository;

class CatMunicipioController extends Controller
{
    protected $repo;

    public function __construct(CatMunicipioRepository $repo)
    {
        $this->repo = $repo;
    }

    public function index()
    {
        $municipios = $this->repo->getAll();
        return view('cat_municipios.index', compact('municipios'));
    }

    public function create()
    {
        return view('cat_municipios.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_municipio' => 'required|string|max:100|unique:cat_municipios,nombre_municipio',
            'clave_municipio' => 'required|string|max:10|unique:cat_municipios,clave_municipio',
        ]);

        $this->repo->create($request->only('nombre_municipio', 'clave_municipio'));
        return redirect()->route('cat_municipios.index')->with('success', 'Municipio creado correctamente');
    }

    public function edit($id)
    {
        $municipio = $this->repo->find($id);
        return view('cat_municipios.edit', compact('municipio'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre_municipio' => 'required|string|max:100|unique:cat_municipios,nombre_municipio,' . $id . ',id_municipio',
            'clave_municipio' => 'required|string|max:10|unique:cat_municipios,clave_municipio,' . $id . ',id_municipio',
        ]);

        $this->repo->update($id, $request->only('nombre_municipio', 'clave_municipio'));
        return redirect()->route('cat_municipios.index')->with('success', 'Municipio actualizado correctamente');
    }

    public function destroy($id)
    {
        $this->repo->delete($id);
        return redirect()
        ->route('cat_municipios.index')
        ->with('success', 'Municipio desactivado correctamente.');
    }

    public function activate($id)
{
    $municipio = $this->repo->find($id);
    $municipio->is_active = 1;
    $municipio->save();

    return redirect()->route('cat_municipios.index')->with('success', 'Municipio activado correctamente.');
}

}
