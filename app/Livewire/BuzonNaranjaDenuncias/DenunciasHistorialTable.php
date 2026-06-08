<?php

namespace App\Livewire\BuzonNaranjaDenuncias;

use App\Repositories\DenunciasBNRepository;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithPagination;

class DenunciasHistorialTable extends Component
{
    use AuthorizesRequests;
    use WithPagination;

    public string $search = '';

    // Propiedades para ordenar
    public string $sortBy = 'date';
    public bool $sortAsc = false;

    protected $denunciaRepository;

    public function boot(DenunciasBNRepository $denunciaRepository) {
        $this->denunciaRepository = $denunciaRepository;
    }

    // Resetear la paginación cuando cambia el término de búsqueda
    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function render()
    {
        $denuncias = $this->denunciaRepository->historialDenuncias($this->search, $this->sortBy, $this->sortAsc);
        return view('livewire.buzon-naranja-denuncias.denuncias-historial-table', ['denuncias' => $denuncias]);

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
