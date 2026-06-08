<?php 
namespace App\Repositories;

use App\Models\BuzonNarajaDenuncia;
use Illuminate\Database\Eloquent\Builder;

class DenunciasBNRepository {

    public function historialDenuncias(string $search, string $sortBy, bool $sortAsc){

        $denuncias = BuzonNarajaDenuncia::query()
            ->select('buzon_naranja.*')

            // Lógica de búsqueda
            ->when($search, function (Builder $query, $search){
                $query->where(function (Builder $q) use ($search) {
                    $q->where('folio', 'like', '%' . $search . '%')
                        ->orWhere('tramite', 'like', '%' . $search . '%');
                });
            })
            // Lógica de Ordenación
            ->orderBy($sortBy, $sortAsc ? 'asc' : 'desc')
            ->paginate(10);

        return $denuncias;

    }

}


?>