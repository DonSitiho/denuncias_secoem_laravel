<?php

namespace App\Repositories;

use App\Models\CatEstados;

class CatEstadosRepository
{
    public function getAll()
    {
        return CatEstados::orderBy('id_estado', 'asc')->get();
    }

    public function find($id)
    {
        return CatEstados::findOrFail($id);
    }

    public function create(array $data)
    {
        return CatEstados::create($data);
    }

    public function update($id, array $data)
    {
        $estado = CatEstados::findOrFail($id);
        $estado->update($data);
        return $estado;
    }

    // Eliminado lógico
    public function delete($id)
    {
        $estado = CatEstados::findOrFail($id);
        $estado->update(['is_active' => 0]);
        return $estado;
    }

    // Reactivar registro
    public function activate($id)
    {
        $estado = CatEstados::findOrFail($id);
        $estado->update(['is_active' => 1]);
        return $estado;
    }
}
