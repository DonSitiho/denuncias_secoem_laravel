<?php

namespace App\Repositories;

use App\Models\Denuncia;
use Illuminate\Database\Eloquent\Builder;

class DenunciasRepository {

    public function denunciasPorResponsable(string $search, string $sortBy, bool $sortAsc){

        // Consulta base con las relaciones necesarias
        $denuncia = Denuncia::denunciasByAreaResponable()
            ->with(['contacto', 'circunstancia.municipio'])
            ->select('denuncia.*')
            ->join('denuncia_circunstancia as dc', 'denuncia.id_denuncia', '=', 'dc.id_denuncia')
            ->leftJoin('datos_contacto_denunciante as dcd', 'denuncia.id_denuncia', '=', 'dcd.id_denuncia')
            ->leftJoin('cat_municipios as cm', 'dc.id_municipio', '=', 'cm.id_municipio')

            // Lógica de Búsqueda
            ->when($search, function (Builder $query, $search){
                $query->where(function (Builder $q) use ($search) {
                    $q->where('denuncia.folio_seguimiento', 'like', '%' . $search . '%')
                        ->orWhere('denuncia.motivo_denuncia', 'like', '%' . $search . '%')
                        // Búsqueda en tablas relacionadas (es más complejo, pero Livewire lo permite)
                        ->orWhere('dcd.nombre_completo', 'like', '%' . $search . '%')
                        ->orWhere('dc.dependencia_involucrada', 'like', '%' . $search . '%')
                        ->orWhere('cm.nombre_municipio', 'like', '%' . $search . '%');
                });
            })
            ->orderBy($sortBy, $sortAsc ? 'asc' : 'desc')
            ->paginate(10); 

        return $denuncia;
    }

    public function totalDenunciasTurnadasResponsable(){

        $totalDenuncias = Denuncia::denunciasTurnadasResponsable()->count();

        return $totalDenuncias;
    }

    public function totalDenunciaAreaResponsable(){

        $totalDenuncias = Denuncia::denunciasArea()->count();

        return $totalDenuncias;
    }

}

?>