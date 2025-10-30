<?php

namespace App\Livewire\OicDenuncias;

use App\Repositories\DenunciasRepository;
use Livewire\Component;
use Livewire\WithPagination;

class MisDenunciasTable extends Component
{

    use WithPagination;

    // Propiedad que almacenará el texto de búsqueda en tiempo real
    public string $search = '';

    // Propiedades para ordenar
    public string $sortBy = 'fecha_recepcion';
    public bool $sortAsc = false; // Ordenar de forma descendente por defecto
    public bool $responsable = false; //


    protected $denunciaRepository;

    public function boot(DenunciasRepository $denunciaRepository){
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

        //return json_encode($denuncias);

        return view('livewire.oic-denuncias.mis-denuncias-table', ['denuncias' => $denuncias]);
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
