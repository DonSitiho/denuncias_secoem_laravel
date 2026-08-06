<?php

namespace App\Livewire\BuzonNaranjaDenuncias;

use App\Repositories\DenunciasRepository;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithPagination;

class DenunciasNuevasTable extends Component
{
    use AuthorizesRequests;
    use WithPagination;

    protected string $paginationTheme = 'bootstrap';

    public string $search = '';

    // Propiedades para ordenar
    public string $sortBy = 'fecha_recepcion';
    public bool $sortAsc = false;

    protected $denunciaRepository;

    public function boot(DenunciasRepository $denunciaRepository) {
        $this->denunciaRepository = $denunciaRepository;
    }

    // Resetear la paginación cuando cambia el término de búsqueda
    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function render()
    {
        //$denuncias = $this->denunciaRepository->denunciasTipo($this->search, $this->sortBy, $this->sortAsc);
        $denuncias = $this->denunciaRepository->denunciasBuzonNaranja($this->search, $this->sortBy, $this->sortAsc);
        //return json_encode($denuncias);

        return view('livewire.buzon-naranja-denuncias.denuncias-nuevas-table', ['denuncias' => $denuncias]);
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
