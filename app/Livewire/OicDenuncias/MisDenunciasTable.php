<?php

namespace App\Livewire\OicDenuncias;

use App\Models\Denuncia;
use App\Repositories\DenunciasRepository;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithPagination;

class MisDenunciasTable extends Component
{
    use AuthorizesRequests;
    use WithPagination;

    protected string $paginationTheme = 'bootstrap';

    // Propiedad que almacenará el texto de búsqueda en tiempo real
    public string $search = '';

    // Propiedades para ordenar
    public string $sortBy = 'fecha_recepcion';
    public bool $sortAsc = false; // Ordenar de forma descendente por defecto
    public bool $responsable = false; //
    public int $id_denuncia;
    public int $status;

    public $mostrarModal = false;



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

    // Funcion que cambia el estatus a en tramite.
    public function pasarATramite($id)
    {

        $this->authorize('oic-denuncia-tramite'); // igual que en un controlador
        $this->id_denuncia = $id;
        $this->status = 3;

        try {

            $this->denunciaRepository->cambiarDenunciaATramite($this->id_denuncia,  $this->status);
            $this->dispatch('success', 'La denuncia ha sido enviada a trámite correctamente.');

        } catch (\Exception $e){
            $this->dispatch('danger', 'Ocurrió un error al enviar la denuncia a trámite');
        }
    }

    public function abrirModal($id){

        $this->id_denuncia = $id;
        $this->mostrarModal = true;

    }
}
