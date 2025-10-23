<?php

namespace App\Repositories;

use App\Models\CatAreaGob;

class CatAreaGobRepository
{
    protected $model;

    public function __construct(CatAreaGob $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        return $this->model->with('padre')->orderBy('id_area')->get();
    }

    public function find($id)
    {
        return $this->model->with('padre', 'hijos')->findOrFail($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $area = $this->find($id);
        $area->update($data);
        return $area;
    }

    public function delete($id)
    {
        $area = $this->find($id);
        $area->is_active = false;
        $area->save();
        return $area;
    }

    public function activate($id)
    {
        $area = $this->find($id);
        $area->is_active = true;
        $area->save();
        return $area;
    }
}
