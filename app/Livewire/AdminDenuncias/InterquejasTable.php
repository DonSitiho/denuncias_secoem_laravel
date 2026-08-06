<?php

namespace App\Livewire\AdminDenuncias;

use App\Models\Interqueja;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;

class InterquejasTable extends Component
{
    use WithPagination;
    protected string $paginationTheme = 'bootstrap';

    // Propiedad que almacenará el texto de búsqueda en tiempo real
    public string $search = '';

    // Propiedades para ordenar
    public string $sortBy = 'fecha_hecho';
    public bool $sortAsc = false; // Ordenar de forma descendente por defecto

     // Campos a buscar
    protected $searchableFields = [
        'dependencia_hecho',
        'nombre_serv',
    ];

    // Resetear la paginación cuando cambia el término de búsqueda
    public function updatingSearch(): void
    {
        $this->resetPage();
    }


    public function render()
    {

    $interquejas = Interqueja::query()
        ->select('interquejas.*')

        // Lógica de Búsqueda
        ->when($this->search, function (Builder $query, $search) {
            $query->where(function (Builder $q) use ($search) {
                $q->where('dependencia_hecho', 'like', '%' . $search . '%')
                    ->orWhere('nombre_serv', 'like', '%' . $search . '%');
            });
        })

        // Lógica de Ordenación
        ->orderBy($this->sortBy, $this->sortAsc ? 'asc' : 'desc')
        ->paginate(10);

        return view('livewire.admin-denuncias.interquejas-table', ['interquejas' => $interquejas]);
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
