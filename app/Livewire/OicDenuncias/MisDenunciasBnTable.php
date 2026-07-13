<?php

namespace App\Livewire\OicDenuncias;

use App\Repositories\DenunciasRepository;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithPagination;

class MisDenunciasBnTable extends Component
{

    use AuthorizesRequests;
    use WithPagination;

    public string $search = '';

    // Propiedades para ordenar
    public string $sortBy = 'fecha_recepcion';
    public bool $sortAsc = false;

    protected $denunciaRepository;

    public function boot(DenunciasRepository $denunciaRepository){
        $this->denunciaRepository = $denunciaRepository;
    }

    public function updatingSearch(): void 
    {
        $this->resetPage();
    }

    public function render()
    {
        $denuncias = $this->denunciaRepository->denunciasBNPorResponsable($this->search, $this->sortBy, $this->sortAsc);

        return view('livewire.oic-denuncias.mis-denuncias-bn-table', ['denuncias' => $denuncias]);
    }

    public function sortBy(string $field): void 
    {
        if ($this->sortBy == $field) {
            $this->sortAsc = !$this->sortAsc;
        } else {
            $this->sortAsc = true;
        }
        $this->sortBy = $field;
    }
}
