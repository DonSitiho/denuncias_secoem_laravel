<?php

namespace App\Livewire\AdminDenuncias;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Denuncia;
use Illuminate\Database\Eloquent\Builder;

class DenunciaTable extends Component
{
    use WithPagination;

    // Propiedad que almacenará el texto de búsqueda en tiempo real
    public string $search = '';

    // Propiedades para ordenar
    public string $sortBy = 'fecha_recepcion';
    public bool $sortAsc = false; // Ordenar de forma descendente por defecto

    // Campos a buscar
    protected $searchableFields = [
        'folio_seguimiento',
        'motivo_denuncia',
        'contacto.nombre_completo',
        'circunstancia.dependencia_involucrada',
        'circunstancia.municipio.nombre_municipio',
    ];

    // Resetear la paginación cuando cambia el término de búsqueda
    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function render()
    {
        // Consulta base con las relaciones necesarias
        $denuncias = Denuncia::query()
            ->with([
                'contacto', 
                'circunstancia.municipio'
            ])
            ->select('denuncia.*') // Necesario para el join/where
            ->join('denuncia_circunstancia as dc', 'denuncia.id_denuncia', '=', 'dc.id_denuncia')
            ->leftJoin('datos_contacto_denunciante as dcd', 'denuncia.id_denuncia', '=', 'dcd.id_denuncia')
            ->leftJoin('cat_municipios as cm', 'dc.id_municipio', '=', 'cm.id_municipio')
            
            // Lógica de Búsqueda
            ->when($this->search, function (Builder $query, $search) {
                $query->where(function (Builder $q) use ($search) {
                    $q->where('denuncia.folio_seguimiento', 'like', '%' . $search . '%')
                      ->orWhere('denuncia.motivo_denuncia', 'like', '%' . $search . '%')
                      // Búsqueda en tablas relacionadas (es más complejo, pero Livewire lo permite)
                      ->orWhere('dcd.nombre_completo', 'like', '%' . $search . '%') 
                      ->orWhere('dc.dependencia_involucrada', 'like', '%' . $search . '%')
                      ->orWhere('cm.nombre_municipio', 'like', '%' . $search . '%');
                });
            })
            
            // Lógica de Ordenación
            ->orderBy($this->sortBy, $this->sortAsc ? 'asc' : 'desc')
            ->paginate(10);
            
        return view('livewire.admin-denuncias.denuncia-table', [
            'denuncias' => $denuncias,
        ]);
    }

    public function sortBy(string $field): void
    {
        if ($this->sortBy === $field) {
            $this->sortAsc = !$this->sortAsc;
        } else {
            $this->sortAsc = true;
        }
        $this->sortBy = $field;
    }
}