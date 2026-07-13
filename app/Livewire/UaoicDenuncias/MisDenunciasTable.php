<?php

namespace App\Livewire\UaoicDenuncias;

use App\Repositories\DenunciasRepository;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithPagination;

class MisDenunciasTable extends Component
{

    use AuthorizesRequests;
    use WithPagination;

    // Propiedad que almacenará el texto de búsqueda en tiempo real
    public string $search = '';

    // Propiedades para ordenar
    public string $sortBy = 'fecha_recepcion';
    public bool $sortAsc = false; // Ordenar de forma descendente por defecto

    protected $denunciaRepository;

    public function boot(DenunciasRepository $denunciaRepository)
    {   
        $this->denunciaRepository = $denunciaRepository;
    }

    // Resetear la paginación cuando cambia el término de búsqueda
    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function render()
    {
        $denuncias = $this->denunciaRepository->denunciasPorResponsable($this->search, $this->sortBy, $this->sortAsc);

        return view('livewire.uaoic-denuncias.mis-denuncias-table', ['denuncias' => $denuncias]);
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
