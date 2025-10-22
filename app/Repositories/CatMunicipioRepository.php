<?php

namespace App\Repositories;

use App\Models\CatMunicipio;

class CatMunicipioRepository
{
    public function getAll()
    {
         return CatMunicipio::all();
    }

    public function find($id)
    {
        return CatMunicipio::findOrFail($id);
    }

    public function create(array $data)
    {
        return CatMunicipio::create($data);
    }

    public function update($id, array $data)
    {
        $municipio = CatMunicipio::findOrFail($id);
        $municipio->update($data);
        return $municipio;
    }

    public function delete($id)
    {
           $municipio = CatMunicipio::findOrFail($id);
           $municipio->is_active = 0;
           $municipio->save();
           return $municipio;        
    }
}
