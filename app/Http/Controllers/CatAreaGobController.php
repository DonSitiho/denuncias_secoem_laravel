<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\CatAreaGobRepository;

class CatAreaGobController extends Controller
{
    protected $catAreaRepo;

    public function __construct(CatAreaGobRepository $catAreaRepo)
    {
        $this->catAreaRepo = $catAreaRepo;
    }

    /**
     * Lista todas las áreas.
     */
    public function index()
    {
        $areas = $this->catAreaRepo->getAll();
        return view('cat_areas_gob.index', compact('areas'));
    }

    /**
     * Mostrar formulario para crear nueva área.
     */
    public function create()
    {
        $areas = $this->catAreaRepo->getAll(); // Para select de área padre
        return view('cat_areas_gob.create', compact('areas'));
    }

    /**
     * Guardar nueva área.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'siglas' => 'nullable|string|max:50',
            'categoria' => 'nullable|string|max:50',
            'id_area_padre' => 'nullable|exists:cat_areas_gob,id_area',
        ]);

        $this->catAreaRepo->create($request->only(['nombre', 'siglas', 'categoria', 'id_area_padre']));

        return redirect()->route('cat_areas_gob.index')->with('success', 'Área creada correctamente.');
    }

    /**
     * Mostrar formulario para editar un área.
     */
    public function edit($id)
    {
        $area = $this->catAreaRepo->find($id);
        $areas = $this->catAreaRepo->getAll(); // Para select de área padre
        return view('cat_areas_gob.edit', compact('area', 'areas'));
    }

    /**
     * Actualizar un área existente.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'siglas' => 'nullable|string|max:50',
            'categoria' => 'nullable|string|max:50',
            'id_area_padre' => 'nullable|exists:cat_areas_gob,id_area',
        ]);

        $this->catAreaRepo->update($id, $request->only(['nombre', 'siglas', 'categoria', 'id_area_padre']));

        return redirect()->route('cat_areas_gob.index')->with('success', 'Área actualizada correctamente.');
    }

    /**
     * Desactivar un área (eliminación lógica).
     */
    public function destroy($id)
    {
        $this->catAreaRepo->delete($id);
        return redirect()->route('cat_areas_gob.index')->with('success', 'Área desactivada.');
    }

    /**
     * Activar un área previamente desactivada.
     */
    public function activate($id)
    {
        $this->catAreaRepo->activate($id);
        return redirect()->route('cat_areas_gob.index')->with('success', 'Área activada nuevamente.');
    }
}
